<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Audio;
use App\Models\CategorieArticle;
use App\Models\CategorieAudio;
use App\Models\CategorieVideo;
use App\Models\Programme;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {

        // catégories d'articles
        $categoriesArticle = CategorieArticle::withCount('articles')
            ->orderByDesc('articles_count')
            ->get();

        // articles
        $articles = Article::with(["media","categorieArticle", "typeArticle"])
            ->withCount("commentaires")
            ->latest()
            ->take(6)
            ->get();

        // 5 catégories vidéo avec nombre de vidéos
        $categoriesVideo = CategorieVideo::withCount('videos')
            ->orderByDesc('videos_count')
            ->take(5)
            ->get();
            
        // Tous les podcasts vidéo
        $videos = Video::with(['media', 'categorieVideo'])
            ->latest()
            ->take(5)
            ->get();

        // 5 catégories audio avec nombre d'audios
        $categoriesAudio = CategorieAudio::withCount('audios')
            ->orderByDesc('audios_count')
            ->take(3)
            ->get();
            
        // Tous les podcasts audio
        $audios = Audio::with(['media', 'categorieAudio'])
            ->latest()
            ->take(6)
            ->get();

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
                    break 2; 
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

        return view('Front.Acceuil.index', compact (
            'categoriesArticle',
            'articles',
            'categoriesVideo',
            'videos',
            'categoriesAudio',
            'audios',
            'programmes', 
            'programmesDuJour', 
            'programmeEnCours', 
            'jourActuel', 
            'programmesParJour'
        ));
    }

}
