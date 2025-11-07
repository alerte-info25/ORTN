<?php

namespace App\Http\Controllers\Front\Actualite;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Audio;
use App\Models\CategorieArticle;
use App\Models\CategorieAudio;
use App\Models\CategorieVideo;
use App\Models\Video;
use Illuminate\Http\Request;

class UserActualiteController extends Controller
{
    public function index()
    {
        // 3 catégories audio les plus actives
        $categoriesAudio = CategorieAudio::withCount('audios')
            ->orderByDesc('audios_count')
            ->take(3)
            ->get();

        // 5 catégories vidéo les plus actives
        $categoriesVideo = CategorieVideo::withCount('videos')
            ->orderByDesc('videos_count')
            ->take(5)
            ->get();

        // catégories d'articles
        $categoriesArticle = CategorieArticle::withCount('articles')
            ->orderByDesc('articles_count')
            ->get();

        // article à la une (le plus récent)
        $featuredArticle = Article::with(['media', 'categorieArticle', 'typeArticle'])
            ->withCount('commentaires')
            ->latest()
            ->first();

        // autres articles, sans celui à la une
        $articles = Article::with(['media', 'categorieArticle', 'typeArticle', 'commentaires'])
            ->withCount("commentaires")
            ->where('id', '!=', optional($featuredArticle)->id) // exclure la une
            ->latest()
            ->paginate(10);

        // Tous les podcasts audio
        $audios = Audio::with(['media', 'categorieAudio'])
            ->latest()
            ->get();

        // Tous les podcasts vidéo
        $videos = Video::with(['media', 'categorieVideo'])
            ->latest()
            ->get();

        return view('Front.Actualites.index', compact(
            'articles',
            'categoriesAudio',
            'categoriesArticle',
            'categoriesVideo',
            'audios',
            'videos',
            'featuredArticle'
        ));
    }


    public function showByCategorie($slug)
    {
        // Trouver la catégorie via le slug
        $categorie = CategorieArticle::where('slug', $slug)
            ->with('articles.media', 'articles.categorieArticle', 'articles.typeArticle')
            ->firstOrFail();

        // Récupérer l'article à la une (le plus récent global)
        $featuredArticle = Article::with(['media', 'categorieArticle', 'typeArticle'])
            ->withCount('commentaires')
            ->latest()
            ->first();

        // Récupérer les articles de cette catégorie,
        // en excluant l'article à la une s'il appartient à cette catégorie
        $articles = $categorie->articles()
            ->where('articles.id', '!=', optional($featuredArticle)->id) // exclu
            ->with(['media', 'categorieArticle', 'typeArticle'])
            ->withCount('commentaires')
            ->latest()
            ->paginate(10);

        return view('Front.Actualites.showArticleByCategory', compact('categorie', 'articles', 'featuredArticle'));
    }


    public function render(string $slug)
    {
        // Récupérer l'article principal via le slug du média
        $article = Article::whereHas('media', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with(['media', 'categorieArticle', 'typeArticle', 'commentaires.user'])->withCount("commentaires")->firstOrFail();

        // catégories d'articles
        $categoriesArticle = CategorieArticle::withCount('articles')
            ->orderByDesc('articles_count')
            ->get();

        // Récupérer les articles similaires (même catégorie ou même type)
        $articlesSimilaires = Article::where('id', '!=', $article->id)
            ->where(function ($query) use ($article) {
                $query->where('categorie_article_id', $article->categorie_article_id)
                    ->orWhere('type_article_id', $article->type_article_id);
            })
            ->with(['media', 'categorieArticle', 'typeArticle'])
            ->latest()
            ->take(4)
            ->get();

        // Incrémente le nombre de vues
        $article->increment('views');

        return view('Front.Actualites.showArticles', compact('article', 'categoriesArticle', 'articlesSimilaires'));
    }


    
}
