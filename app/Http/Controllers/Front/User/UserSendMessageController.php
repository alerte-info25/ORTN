<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserSendMessageController extends Controller
{
    public function index()
    {
        return view('Front.Contact.index');
    }

    public function send(Request $request)
    {
        $data = collect($request->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]))->mapWithKeys(function($value, $key) {
            return [\Illuminate\Support\Str::snake($key) => $value];
        })->toArray();

        // Pour debug (à retirer ensuite)
        // dd($data);

        // Envoi du mail à l’admin
        Mail::to(env('MAIL_USERNAME'))->queue(new ContactMessage($data));

        // Envoi d’une copie à l’utilisateur
        Mail::to($data['email'])->queue(
            (new ContactMessage($data))->subject('Copie de votre message à ORTN')
        );

        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.'
        ]);
    }
}
