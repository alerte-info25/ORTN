<?php

namespace App\Http\Controllers\Front\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Event\StorePaymentRequest;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Payment;
use App\Services\CinetPay\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getData ($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return $event;
    }

    public function index ($slug)
    {
        $event = $this->getData($slug);
        return view ("Front.Evenements.payment", compact("event"));
    }

    /**
     * Traite le formulaire de payment
     */
    public function store(StorePaymentRequest $request, $slug)
    {
        try {
            $data = $request->validated();
            
            $event = Event::where('slug', $slug)->firstOrFail();

            $paymentData = [
                'event_id' => $event->id,
                'participant_id' => null,
                'user_id' => Auth::id(), 
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'organisation' => $data['organisation'] ?? null,
                'nationalite' => $data['nationalite'] ?? null,
                'pays' => $data['pays'] ?? null,
                'ville' => $data['ville'] ?? null,
                'adresse' => $data['adresse'] ?? null,
                'code_postal' => $data['code_postal'] ?? null,
                'montant' => $data["montant"],
                'methode_paiement' => "all",
                'transaction_id' => Payment::generateTransactionId(),
                'notify_url' => route('payment.notify'),
                'return_url' => route('payment.return'),
                'statut' => Payment::STATUT_EN_ATTENTE,
            ];
            
            $payment = Payment::create($paymentData);

            $resultatPaiement = $this->paymentService->initierPaiement($payment);

            if (isset($resultatPaiement['data']['payment_url'])) {
                return redirect($resultatPaiement['data']['payment_url']);
            }

            throw new \Exception("Impossible de générer le lien de paiement");

        } catch (\Exception $e) {
            Log::error('Erreur payment', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'slug' => $slug
            ]);

            return redirect()->back()
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Erreur lors du traitement de votre payment: ' . $e->getMessage()
                ])
                ->withInput();
        }
    }

    public function paymentReturn(Request $request)
    {
        try {
            $transactionId = $request->get('transaction_id');
            
            if (!$transactionId) {
                return redirect()->route('ortn.payments')
                    ->with('alert', [
                        'type' => 'error',
                        'message' => 'Transaction non trouvée'
                    ]);
            }

            $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();

            $infoPaiement = $this->paymentService->verifierPaiement($transactionId);
            
            $succes = $this->paymentService->mettreAJourStatut($payment, $infoPaiement);

            if ($succes) {

                // Récupérer le user_id directement depuis le payment
                $userId = $payment->user_id;

                $participant = Participant::create([
                    'user_id'     => $userId,
                    'nom'         => $payment->nom,
                    'prenom'      => $payment->prenom,
                    'email'       => $payment->email,
                    'telephone'   => $payment->telephone,
                    'organisation'=> $payment->organisation ?? null,
                    'payment_id'  => $payment->id,
                ]);

                $payment->participant_id = $participant->id;
                $payment->save();

                if ($payment->event_id) {
                    $participant->events()->attach($payment->event_id);
                }

                return view('Front.Evenements.success', compact('payment'));

            } else {
                return view('Front.Evenements.error', compact('payment'));
            }

        } catch (\Exception $e) {
            Log::error('Erreur retour paiement', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Erreur lors de la vérification du paiement'
                ]);
        }
    }

    /**
     * Notification de CinetPay (webhook)
     * CinetPay appelle cette URL pour nous informer du paiement
     */
    public function paymentNotify(Request $request)
    {
        try {
            $transactionId = $request->get('cpm_trans_id');
            
            if (!$transactionId) {
                Log::error('Notification sans transaction_id', $request->all());
                return response()->json(['status' => 'error'], 400);
            }

            $payment = Payment::where('transaction_id', $transactionId)->first();
            
            if (!$payment) {
                Log::error('payment introuvable', ['transaction_id' => $transactionId]);
                return response()->json(['status' => 'error'], 404);
            }

            $infoPaiement = $this->paymentService->verifierPaiement($transactionId);
            
            $this->paymentService->mettreAJourStatut($payment, $infoPaiement);

            Log::info('Notification traitée avec succès', [
                'payment_id' => $payment->id,
                'statut' => $payment->statut
            ]);

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Erreur notification', [
                'message' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json(['status' => 'error'], 500);
        }
    }
}