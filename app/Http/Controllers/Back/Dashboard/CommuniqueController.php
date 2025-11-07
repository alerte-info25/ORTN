<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\Dashboard\CommuniqueRequest;
use App\Models\Communique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CommuniqueController extends Controller
{
    public function index ()
    {
        return view ("back.communiques.index");
    }

    /**
     * Store a newly created communique in storage.
     */
    public function store(CommuniqueRequest $request)
    {
        try {
            $validated = $request->validated();

            // dd($validated);

            \Log::info('Validated data:', $validated);

            // Générer le slug à partir du titre
            $validated['slug'] = Str::slug($validated['title']);

            // Vérifier l'unicité du slug et ajouter un suffixe si nécessaire
            $originalSlug = $validated['slug'];
            $count = 1;
            while (Communique::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
            
            // Ajouter l'ID de l'utilisateur connecté
            $validated['user_id'] = auth()->id();
            
            // Traiter les images
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('communiques', 'public');
                    $imagePaths[] = $path;
                }
                $validated['images'] = json_encode($imagePaths);
            }
            
            // Créer le communiqué
            $communique = Communique::create($validated);
            
            return redirect()
                ->route('dashboard.communiques.show', $communique->slug)
                ->with('success', 'Le communiqué a été publié avec succès.');
                
        } catch (\Exception $e) {

            Log::error('Erreur communiqué:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return back()
                ->withInput()
                ->with('alert', [
                    'type' => 'error', 
                    'message' => 'Erreur: ' . $e->getMessage()
                ]);
        }
    }

    /**
     * Display the specified communique.
     */
    public function show(string $slug)
    {
        try {
            $communique = Communique::where('slug', $slug)
                ->with('user') 
                ->firstOrFail();
            
            // Incrémenter le compteur de vues
            $communique->increment('views_count');
            
            // Décoder les images JSON
            $images = $communique->images ? json_decode($communique->images, true) : [];
            
            return view('back.communiques.show', compact('communique', 'images'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Le communiqué demandé n\'existe pas.');
        }
    }

    public function liste()
    {
        $communiques = Communique::with('user')->latest()->paginate(10);
        $allCount = Communique::count();
        $viewsCount = Communique::sum('views_count');

        return view('back.communiques.liste', compact('communiques', 'allCount', 'viewsCount'));
    }

    /**
     * Remove the specified communique from storage.
     */
    public function destroy(Communique $communique)
    {
        try {
            // Vérifier que l'utilisateur est autorisé à supprimer
            if (auth()->id() !== $communique->user_id) {
                return back()->with('alert', [
                    'type' => 'error', 
                    'message' => 'Vous n\'êtes pas autorisé à supprimer ce communiqué.'
                ]);
            }
            
            // Supprimer les images associées du stockage
            if ($communique->images) {
                $images = json_decode($communique->images, true);
                foreach ($images as $imagePath) {
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
            
            // Supprimer le communiqué
            $communique->delete();
            
            return redirect()
                ->back()
                ->with('alert', [
                    'type' => 'success', 
                    'message' => 'Le communiqué a été supprimé avec succès.'
                ]);
                
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression du communiqué.');
        }
    }
    
}
