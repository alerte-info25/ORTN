<?php

namespace App\Http\Controllers\Front\Podcast;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\CategorieAudio;
use App\Models\CategorieVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function getAudioCategories()
    {
        // Récupère les catégories avec le nombre d'audios liés
        $categories = CategorieAudio::withCount('audios')
            ->orderBy('libelle')
            ->get();

        return $categories;
    }

    public function categoryAudio($slug)
    {
        // Récupère la catégorie via le slug
        $categorie = CategorieAudio::where('slug', $slug)->firstOrFail();
        $categoryPodcasts = CategorieAudio::withCount('audios')->get();

        $audios = Audio::with(['media', 'categorieAudio'])
            ->where('categorie_audio_id', $categorie->id)
            ->latest()
            ->get(); 

        $categories = $this->getAudioCategories();

        return view('Front.Podcasts.podcastCategory', compact('audios', 'categories', 'categorie', 'categoryPodcasts'));
    }
    
    public function indexAudio()
    {
        $audios = Audio::with(['media', 'categorieAudio'])->latest()->paginate(10);
        $categories = $this->getAudioCategories();

        return view('Front.Podcasts.audios', compact('audios', 'categories'));
    }

    public function getVideoCategories()
    {
        // Récupère les catégories avec le nombre de vidéos liées
        $categories = CategorieVideo::withCount('videos')
            ->orderBy('libelle')
            ->get();

        return $categories;
    }

    public function indexVideo()
    {
        $videos = Video::with(['media', 'categorieVideo'])->latest()->paginate(10);
        $categories = $this->getVideoCategories();

        return view('Front.Podcasts.videos', compact('videos', 'categories'));
    }

    public function categoryVideo($slug)
    {
        // Récupère la catégorie via le slug
        $categorie = CategorieVideo::where('slug', $slug)->firstOrFail();
        $categoryPodcasts = CategorieVideo::withCount('videos')->get();

        $videos = Video::with(['media', 'categorieVideo'])
            ->where('categorie_video_id', $categorie->id)
            ->latest()
            ->get(); 

        $categories = $this->getVideoCategories();

        return view('Front.Podcasts.podcastCategory', compact('videos', 'categories', 'categorie', 'categoryPodcasts'));
    }
    
}
