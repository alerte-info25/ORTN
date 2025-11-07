<?php

namespace App\Http\Controllers\Front\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Newsletter\UserNewsletterRequest;
use App\Models\Newsletter;
use App\Models\NewsLetterAbonne;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store (UserNewsletterRequest $request)
    {
        // dd($request->validated());

        $data = $request->validated();

        NewsLetterAbonne::firstOrCreate(
            ['email' => $data['email']],
            [
                'date_abonnement' => now(),
                'actif' => true
            ]
        );

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Votre mail a bien été enregistré vous recevrez les dernières informations.'
        ]);
    }
}
