<?php

namespace App\Http\Controllers\Front\Communiques;

use App\Http\Controllers\Controller;
use App\Models\Communique;
use Illuminate\Http\Request;

class CommuniquesController extends Controller
{
    public function index()
    {
        $communiques = Communique::with('user')->latest()->get();

        // Incrémenter uniquement ceux affichés
        foreach ($communiques as $communique) {
            $communique->increment('views_count');
        }

        return view("Front.Communiques.index", compact("communiques"));
    }


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
            
            return view('Front.Communiques.show', compact('communique', 'images'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404, 'Le communiqué demandé n\'existe pas.');
        }
    }
}
