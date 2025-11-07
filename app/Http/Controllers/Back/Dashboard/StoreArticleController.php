<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\StoreArticleRequest;
use App\Mail\Newsletter\NewsLetterMail;
use App\Models\Article;
use App\Models\CategorieArticle;
use App\Models\Media;
use App\Models\MediaTags;
use App\Models\NewsLetterAbonne;
use App\Models\Tags;
use App\Models\TypeArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreArticleController extends Controller
{
    public function getData ()
    {
        $articles = Article::with(["media", "categorieArticle", "typeArticle", "commentaires"])->latest()->paginate(10);
        $articlesCount = Article::count();

        return compact (
            "articles",
            "articlesCount"
        );
    }

    public function render ()
    {
        return view ("back.articles.articlesListe", $this->getData());
    }

    public function index ()
    {
        // dd("atteint");
        return view ("back.articles.articles", $this->getData());
    }

    private function attachTagsToArticleAndMedia($tagsString, Article $article, Media $media)
    {
        $tags = explode(',', $tagsString);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag) {
                $tagModel = Tags::firstOrCreate([
                    'libelle' => $tag,
                    'slug' => Str::slug($tag)
                ]);

                MediaTags::firstOrCreate([
                    'media_id' => $media->id,
                    'tags_id' => $tagModel->id
                ]);
            }
        }
    }

    public function edit (Article $article)
    {
        $article->load(["media", "categorieArticle", "typeArticle", "commentaires"]);
        return view ("back.articles.articles", compact("article"));
    }

    public function store (StoreArticleRequest $request)
    {
        try {

            // dd($request->validated());

            DB::beginTransaction();

            $data = $request->validated();

            $categoryArticle = CategorieArticle::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data["category"])
            ]);

            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Media::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $imagePath = null;
            if ($request->hasFile('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();

                $nextId = (Article::max('id') ?? 0) + 1;
                $filename = 'article-' . $nextId . '-' . time() . '.' . $extension;

                // Dossier = "articles/2025-10-14" par exemple
                $folder = 'articles/' . now()->format('Y-m-d');

                // Stockage dans le dossier public
                $imagePath = $request->file('image')->storeAs($folder, $filename, 'public');

            }

            $typeArticle = TypeArticle::firstOrCreate([
                'libelle' => $data['type'],
                'slug' => $data['type'] . " - " . uniqid()
            ]);

            // Création du media
            $media = Media::create([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => $imagePath,
            ]);

            $article = Article::create([
                'media_id' => $media->id,
                'categorie_article_id' => $categoryArticle->id,
                'type_article_id' => $typeArticle->id,
                'sous_titre' => $data['subtitle']
            ]);

            if (!empty($data['tags'])) {
                $this->attachTagsToArticleAndMedia($data['tags'], $article, $media);
            }

            // foreach (NewsLetterAbonne::where('actif', true)->get() as $abonne) {
            //     // dd($abonne);
            //     Mail::to($abonne->email)->queue(new NewsLetterMail($article));
            // }

            DB::commit();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Article enregistré avec succès.'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            Log::error('Erreur store Article ', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement du Article .'
            ]);

        }
        
    }

    public function update(StoreArticleRequest $request, Article $article)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            // Catégorie
            $categoryArticle = CategorieArticle::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data['category'])
            ]);

            // Slug unique (évite collision)
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Media::where('slug', $slug)
                ->where('id', '!=', $article->media->id)
                ->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }

            // Gestion de l'image (remplace l'ancienne)
            $imagePath = $article->media->image;
            if ($request->hasFile('image')) {
                // Supprimer l’ancienne image si elle existe
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = 'article-' . $article->id . '-' . time() . '.' . $extension;
                $folder = 'articles/' . now()->format('Y-m-d');
                $imagePath = $request->file('image')->storeAs($folder, $filename, 'public');
            }

            // Type d’article
            $typeArticle = TypeArticle::firstOrCreate([
                'libelle' => $data['type'],
                'slug' => Str::slug($data['type']) . '-' . uniqid()
            ]);

            // Mise à jour du média
            $article->media->update([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => $imagePath,
            ]);

            // Mise à jour de l’article
            $article->update([
                'categorie_article_id' => $categoryArticle->id,
                'type_article_id' => $typeArticle->id,
                'sous_titre' => $data['subtitle']
            ]);

            // Tags (on supprime les anciens avant)
            if (!empty($data['tags'])) {
                MediaTags::where('media_id', $article->media->id)->delete();
                $this->attachTagsToArticleAndMedia($data['tags'], $article, $article->media);
            }

            // foreach (NewsLetterAbonne::where('actif', true)->get() as $abonne) {
            //     // dd($abonne);
            //     Mail::to($abonne->email)->queue(new NewsLetterMail($article));
            // }

            DB::commit();

            return to_route('dashboard.articlesListe')->with('alert', [
                'type' => 'success',
                'message' => 'Article mis à jour avec succès.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur update Article', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour de l’article.'
            ]);
        }
    }

    public function destroy(Article $article)
    {
        if ($article->media) {
            // Suppression de l'image physique
            if ($article->media->image && Storage::disk('public')->exists($article->media->image)) {
                Storage::disk('public')->delete($article->media->image);
            }
            $article->media->delete();
        }

        $article->delete();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Article supprimé avec succès !'
        ]);
    }

}
