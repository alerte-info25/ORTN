<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\sondageStoreRequest;
use App\Models\ClientSondage;
use App\Models\Sondage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sondageController extends Controller
{
    public function getData ()
    {
        $sondagesAll = Sondage::with(["users", "redacteur"])->paginate(10);
        $sondagesCount = Sondage::count();
        $sondagesActif = Sondage::where("date_fin", ">", now())->count();
        $sondagesParticipations = ClientSondage::count();

        return compact (
            "sondagesAll",
            "sondagesCount",
            "sondagesActif",
            "sondagesParticipations"
        );
    }
    public function index ()
    {   
        return view ("back.sondages.sondages", $this->getData());
    }

    public function render ()
    {
        return view ("back.sondages.sondagesListe", $this->getData());
    }

    public function store (sondageStoreRequest $request)
    {
        // dd($request->validated());

        $data = $request->validated();

        $sondage = Sondage::create([
            'redacteur_id' => Auth::id(),
            'titre' => $data['title'],
            'description' => $data['description'] ?? null,
            'option1' => $data['option1'],
            'option2' => $data['option2'],
            'option3' => $data['option3'] ?? null,
            'option4' => $data['option4'] ?? null,
            'option5' => $data['option5'] ?? null,
            'date_debut' => $data['start_date'] ?? null,
            'date_fin' => $data['end_date'] ?? null,
            'actif' => true
        ]);

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Sondage créé avec succès',
        ]);
    }

    public function delete (Sondage $sondage)
    {
        try {
            $sondage->delete();

            return redirect()->back()->with('alert', [
                'message' => "sondage supprimé avec succès",
                'type' => 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'message' => "Impossible de supprimer le sondage : " . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }
}
