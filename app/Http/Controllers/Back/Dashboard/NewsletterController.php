<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\StoreNewsLetterRequest;
use App\Mail\Newsletter\NewsLetterMail;
use App\Models\CategorieNewsletter;
use App\Models\Media;
use App\Models\Newsletter;
use App\Models\NewsLetterAbonne;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function getData ()
    {
        $newsletters = Newsletter::with(["media", "categorieNewsletter"])->latest()->paginate(10);
        $newslettersCount = Newsletter::count();
        $abonnesCount = NewsLetterAbonne::count();
        
        return compact(
            "newsletters",
            "newslettersCount",
            "abonnesCount"
        );
    }

    public function index ()
    {
        return view ("back.newsletters.newsletters", $this->getData());
    }

    public function render ()
    {
        return view ("back.newsletters.newslettersListe", $this->getData());
    }

    public function store(StoreNewsLetterRequest $request)
    {     
        // dd($request->validated());
        
        $data = $request->validated();

        try {

            DB::beginTransaction();

            // Gestion de l’image
            if ($request->hasFile('cover_image')) {
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $filename = 'newsletter-' . time() . '.' . $extension;

                // Crée un dossier avec la date du jour 
                $folder = 'newsletters/' . now()->format('Y-m-d');

                // Sauvegarde dans storage/app/public/newsletters/2025-10-13/
                $data['cover_image'] = $request->file('cover_image')->storeAs($folder, $filename, 'public');
            }

            // title
            // subject
            // category
            // content
            // cover_image

            $date = Carbon::now('Africa/Abidjan');

            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;
            $counter = 1;

            while (Media::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $media = Media::create([
                'redacteur_id' => Auth::id(),
                'titre' => $data['title'],
                'slug' => $slug,
                'description' => $data['content'],
                'image' => $data['cover_image'],
            ]);

            $tags = Tags::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data['category'])
            ]);

            $categorieNewsletter = CategorieNewsletter::firstOrCreate([
                'libelle' => $data['category'],
                'slug' => Str::slug($data['category'])
            ]);

            // dd([
            //     $media->id,
            //     $tags->id,
            //     $categorieNewsletter->id
            // ]);

            $newsletter = Newsletter::create([
                'media_id' => $media->id,
                'categorie_newsletter_id' => $categorieNewsletter->id,
                'subject' => $data['subject']
            ]);

            // $newsletter->load('media');

            foreach (NewsLetterAbonne::where('actif', true)->get() as $abonne) {
                // dd($abonne);
                Mail::to($abonne->email)->queue(new NewsLetterMail($newsletter));
            }

            DB::commit();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Newsletter enregistrée et envoyée avec succès.'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // return redirect()->back()->with('alert', [
            //     'type' => 'error',
            //     'message' => 'Impossible d\'enregistrer la newsletter.'
            // ]);

            dd($e->getMessage(), $e->getTraceAsString());
        }

    }

    public function destroy(NewsLetter $newsletter)
    {
        $newsletter->delete();

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Opération réussie'
        ]);
    }
}
