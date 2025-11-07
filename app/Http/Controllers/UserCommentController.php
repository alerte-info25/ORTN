<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'contenu' => 'required|string|max:10000',
        ]);

        Commentaire::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
            'contenu' => $request->contenu,
        ]);

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Commentaire publié avec succès.'
        ]);
    }
}
