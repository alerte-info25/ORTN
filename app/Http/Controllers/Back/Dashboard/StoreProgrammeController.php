<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\StoreProgrammeRequest;
use App\Http\Requests\Back\Dashboard\UpdateProgrammeRequest;
use App\Models\Programme;
use App\Models\TypeProgramme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreProgrammeController extends Controller
{
    public function getData ()
    {
        $programmes = Programme::with(["redacteur", "typeProgramme"])->latest()->paginate(10);
        $programmesCount = Programme::count();

        return compact (
            "programmes",
            "programmesCount"
        );
    }

    public function index ()
    {
        return view ("back.programmes.programmes", $this->getData());
    }

    public function render ()
    {
        return view ("back.programmes.programmesList", $this->getData());
    }

    public function store(StoreProgrammeRequest $request)
    {
        try {

            // dd($request->validated());

            $data = $request->validated();

            DB::beginTransaction();

            // Génération du slug unique
            $baseSlug = Str::slug($data['nom']);
            $slug = $baseSlug;
            $counter = 1;

            while (Programme::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $typeProgramme = TypeProgramme::firstOrCreate([
                'libelle' => $data['programme']
            ]);

            // Encodage des jours de diffusion en JSON
            $joursDiffusion = json_encode($data['jours'] ?? []);

            // Création du programme
            $programme = Programme::create([
                "type_programme_id" => $typeProgramme->id,
                "redacteur_id" => Auth::id(),
                "nom" => $data['nom'],
                "description" => $data['description'],
                "slug" => $slug,
                "animateur" => $data['animateur'],
                "jour_diffusion" => json_encode($data['jours'] ?? []),
                "heure_debut1" => $data['heure_debut1'],
                "heure_fin1" => $data['heure_fin1'],
                "heure_debut2" => $data['heure_debut2'],
                "heure_fin2" => $data['heure_fin2'],
                "heure_debut3" => $data['heure_debut3'] ?: null,
                "heure_fin3" => $data['heure_fin3'] ?: null,
                "heure_debut4" => $data['heure_debut4'] ?: null,
                "heure_fin4" => $data['heure_fin4'] ?: null,
            ]);

            DB::commit();

            return redirect()->back()->with('alert', [
                'message' => 'Programme enregistré avec succès',
                'type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erreur store programme', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de l\'enregistrement du programme.'
            ]);
        }
    }

    public function edit (Programme $programme)
    {
        $programme->load(["redacteur", "typeProgramme"]);
        return view ("back.programmes.programmes", compact("programme"));
    }

    public function update(UpdateProgrammeRequest $request, Programme $programme)
    {
        try {
            $data = $request->validated();

            DB::beginTransaction();

            // Génération du slug mis à jour si le nom change
            $baseSlug = Str::slug($data['nom']);
            $slug = $baseSlug;
            $counter = 1;

            while (Programme::where('slug', $slug)->where('id', '!=', $programme->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Mise à jour ou création du type de programme
            $typeProgramme = TypeProgramme::firstOrCreate([
                'libelle' => $data['programme']
            ]);

            // Encodage des jours en JSON
            $joursDiffusion = json_encode($data['jours'] ?? []);

            // Mise à jour du programme
            $programme->update([
                'type_programme_id' => $typeProgramme->id,
                'nom' => $data['nom'],
                'description' => $data['description'],
                'slug' => $slug,
                'animateur' => $data['animateur'],
                'jour_diffusion' => $joursDiffusion,
                'heure_debut1' => $data['heure_debut1'],
                'heure_fin1' => $data['heure_fin1'],
                'heure_debut2' => $data['heure_debut2'],
                'heure_fin2' => $data['heure_fin2'],
                'heure_debut3' => $data['heure_debut3'] ?? '',
                'heure_fin3' => $data['heure_fin3'] ?? '',
                'heure_debut4' => $data['heure_debut4'] ?? '',
                'heure_fin4' => $data['heure_fin4'] ?? '',
            ]);

            DB::commit();

            return redirect()->back()->with('alert', [
                'message' => 'Programme mis à jour avec succès',
                'type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erreur update programme', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Une erreur est survenue lors de la mise à jour du programme.'
            ]);
        }
    }


    public function destroy (Programme $programme)
    {
        try {

            $programme->delete();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Programme supprimé avec succeès'
            ]);

        } catch (\Exception $e) {

            Log::error('Erreur suppression programme', ['exception' => $e]);

            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => 'Erreur rencontée lors de la suppression du programme'
            ]);
        }
        
    }
}
