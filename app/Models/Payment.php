<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom', 
        'email',
        'telephone',
        'nationalite',
        'pays',
        'ville',
        'adresse',
        'code_postal',
        'montant',
        'methode_paiement',
        'transaction_id',
        'statut',
        'notify_url',
        'return_url',
        'cinetpay_transaction_id',
        'payment_token',
        'date_heure_payment',
        'organisation',
        'event_id',
        'user_id'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_heure_payment' => 'datetime'
    ];

    // Statuts possibles
    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_PAYE = 'paye';
    const STATUT_ECHOUE = 'echoue';
    const STATUT_ANNULE = 'annule';

    /**
     * Générer un ID de transaction unique
     */
    public static function generateTransactionId()
    {
        return 'payment_' . time() . '_' . rand(1000, 9999);
    }

    /**
     * Marquer comme payé
     */
    public function markAsPaid($cinetpayData = [])
    {
        $this->update([
            'statut' => self::STATUT_PAYE,
            'cinetpay_transaction_id' => $cinetpayData['operator_id'] ?? null,
            'payment_token' => $cinetpayData['payment_token'] ?? null,
            'date_heure_payment' => now(),
        ]);
    }

    /**
     * Marquer comme échoué
     */
    public function markAsFailed()
    {
        $this->update([
            'statut' => self::STATUT_ECHOUE
        ]);
    }

    public function participants ()
    {
        return $this->belongsTo(Participant::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
