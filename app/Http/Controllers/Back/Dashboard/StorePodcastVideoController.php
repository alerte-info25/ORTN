<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\StorePodcastVideoRequest;
use App\Models\CategorieVideo;
use App\Models\Media;
use App\Models\MediaTags;
use App\Models\Tags;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StorePodcastVideoController extends Controller
{
    public function getData ()
    {
        $videos = Video::with(["media", "categorieVideo"])->latest()->paginate(10);
        $VideosCount = Video::count();

        return compact (
            "videos",
            "VideosCount"
        );
    }

    public function index ()
    {
        return view ("back.podcasts.video", $this->getData());
    }

    public function render ()
    {
        return view ("back.podcasts.videosList", $this->getData());
    }

    private function attachTagsToVideoAndMedia($tagsString, Video $video, Media $media)
    {
        $tags = explode(',', $tagsString);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag) {
                $tagModel = Tags::firstOrCreate([
                    'libelle' => $tag,
                    'slug' => Str::slug($tag)
                ]);

                // $video->tags()->syncWithoutDetaching([$tagModel->id]);

                MediaTags::firstOrCreate([
                    'media_id' => $media->id,
                    'tags_id' => $tagModel->id
                ]);
            }
        }
    }

    public function store (StorePodcastVideoRequest $request)
    {
        // dd($request->validated());

        try {

            DB::beginTransaction();

            $data = $request->validated();

            $categoryVideo = CategorieVideo::firstOrCreate([
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

            // Création du media
            $media = Media::create([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => env("DEFAULT_IMAGE_PODCASTS"),
            ]);

            $video = Video::create([
                'media_id' => $media->id,
                'categorie_video_id' => $categoryVideo->id,
                'url_video' => $data['url'],
                'subtitle' => $data['subtitle']
            ]);

            if (!empty($data['tags'])) {
                $this->attachTagsToVideoAndMedia($data['tags'], $video, $media);
            }

            DB::commit();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Podcasts enregistré avec succès.'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            Log::error('Erreur store podcast video', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement du podcast.'
            ]);

        }
    }

    public function edit (Video $video)
    {
        $video->load(['media', 'categorieVideo']);
        return view ("back.podcasts.video", compact("video"));
    }

    public function update(StorePodcastVideoRequest $request, Video $video)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            $categoryVideo = CategorieVideo::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data["category"])
            ]);

            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Media::where('slug', $slug)->where('id', '!=', $video->media->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $video->media->update([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => env("DEFAULT_IMAGE_PODCASTS"),
            ]);

            $video->update([
                'categorie_video_id' => $categoryVideo->id,
                'url_video' => $data['url'],
                'subtitle' => $data['subtitle']
            ]);

            if (!empty($data['tags'])) {
                $this->attachTagsToVideoAndMedia($data['tags'], $video, $video->media);
            }

            DB::commit();

            return to_route("dashboard.videosList")->with('alert', [
                'type' => 'success',
                'message' => 'Podcast mis à jour avec succès.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Erreur mise à jour store podcast vidéo', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour du podcast.'
            ]);
        }
    }

    public function destroy(Video $video)
    {
        if ($video->media) {
            $video->media->delete();
        }

        $video->delete();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'vidéo supprimé avec succès !'
        ]);
    }

}
