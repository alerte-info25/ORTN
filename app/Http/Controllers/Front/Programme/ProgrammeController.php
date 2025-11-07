<?php

namespace App\Http\Controllers\Front\Programme;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{

    public function getData()
    {
        $jourActuel = strtolower(Carbon::now()->locale('fr')->dayName);
        $heureActuelle = Carbon::now()->format('H:i:s');

        $programmes = Programme::latest()->get()->map(function ($programme) {
            $programme->jour_diffusion = json_decode($programme->jour_diffusion, true);
            return $programme;
        });

        // Programmes du jour actuel
        $programmesDuJour = $programmes->filter(function ($programme) use ($jourActuel) {
            return in_array($jourActuel, $programme->jour_diffusion ?? []);
        });

        // Programme actuellement en cours
        $programmeEnCours = null;

        foreach ($programmesDuJour as $programme) {
            for ($i = 1; $i <= 4; $i++) {
                $start = data_get($programme, 'heure_debut'.$i);
                $end   = data_get($programme, 'heure_fin'.$i);

                if ($start && $end && $heureActuelle >= $start && $heureActuelle <= $end) {
                    $programmeEnCours = (object)[
                        'nom' => $programme->nom,
                        'description' => $programme->description,
                        'animateur' => $programme->animateur,
                        'categorie' => optional($programme->typeProgramme)->libelle,
                        'heure_debut' => $start,
                        'heure_fin' => $end,
                        'jours' => implode(', ', $programme->jour_diffusion ?? []),
                        'image_animateur' => $programme->image_animateur,
                    ];
                    break 2; // on arrête tout, on a trouvé le bon
                }
            }
        }

        $joursOrdonnés = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        $programmesParJour = $programmes->flatMap(function ($programme) {
            return collect($programme->jour_diffusion ?? [])->map(function ($jour) use ($programme) {
                return [
                    'jour' => strtolower($jour),
                    'programme' => $programme,
                ];
            });
        })->groupBy('jour');

        $programmesParJour = collect($joursOrdonnés)->mapWithKeys(function ($jour) use ($programmesParJour) {
            return [$jour => $programmesParJour->get($jour, collect())];
        })->filter(function ($groupes) {
            return $groupes->isNotEmpty();
        });

        return compact('programmes', 'programmesDuJour', 'programmeEnCours', 'jourActuel', 'programmesParJour');
    }


    public function index ()
    {
        return view('Front.Programmes.index', $this->getData());
    }

}
