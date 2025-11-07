<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\StorePodcastAudioRequest;
use App\Models\Audio; 
use App\Models\CategorieAudio;
use App\Models\Media;
use App\Models\MediaTags;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StorePodcastAudioController extends Controller
{
    public function getData()
    {
        $audios = Audio::with(["media", "categorieAudio"])->latest()->paginate(10);
        $audiosCount = Audio::count();

        return compact (
            "audios",
            "audiosCount"
        );
    }

    public function index ()
    {
        return view ("back.podcasts.audio", $this->getData());
    }

    public function render ()
    {
        return view ("back.podcasts.audiosList", $this->getData());
    }

    private function attachTagsToAudioAndMedia($tagsString, Audio $audio, Media $media)
    {
        $tags = explode(',', $tagsString);
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if ($tag) {
                $tagModel = Tags::firstOrCreate([
                    'libelle' => $tag,
                    'slug' => Str::slug($tag)
                ]);

                // $audio->tags()->syncWithoutDetaching([$tagModel->id]);

                MediaTags::firstOrCreate([
                    'media_id' => $media->id,
                    'tags_id' => $tagModel->id
                ]);
            }
        }
    }

    public function store (StorePodcastAudioRequest $request)
    {
        try {

            DB::beginTransaction();

            $data = $request->validated();

            $categoryAudio = CategorieAudio::firstOrCreate([
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

            $audio = Audio::create([
                'media_id' => $media->id,
                'categorie_audio_id' => $categoryAudio->id,
                'url_audio' => $data['url'],
                'subtitle' => $data['subtitle']
            ]);

            if (!empty($data['tags'])) {
                $this->attachTagsToAudioAndMedia($data['tags'], $audio, $media);
            }

            DB::commit();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Podcasts enregistré avec succès.'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            Log::error('Erreur store podcast audio', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement du podcast.'
            ]);

        }
        
    }

    public function edit (Audio $audio)
    {
        $audio->load(['media', 'categorieAudio']);
        return view ("back.podcasts.audio", compact("audio"));
    }

    public function update(StorePodcastAudioRequest $request, Audio $audio)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();

            $categoryAudio = CategorieAudio::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data["category"])
            ]);

            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Media::where('slug', $slug)->where('id', '!=', $audio->media->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $audio->media->update([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => env("DEFAULT_IMAGE_PODCASTS"),
            ]);

            $audio->update([
                'categorie_audio_id' => $categoryAudio->id,
                'url_audio' => $data['url'],
                'subtitle' => $data['subtitle']
            ]);

            if (!empty($data['tags'])) {
                $this->attachTagsToAudioAndMedia($data['tags'], $audio, $audio->media);
            }

            DB::commit();

            return to_route("dashboard.audiosList")->with('alert', [
                'type' => 'success',
                'message' => 'Podcast mis à jour avec succès.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            Log::error('Erreur mise à jour store podcast audio', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour du podcast.'
            ]);
        }
    }


    public function destroy(Audio $audio)
    {
        if ($audio->media) {
            $audio->media->delete();
        }

        $audio->delete();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Audio supprimé avec succès !'
        ]);
    }

}
