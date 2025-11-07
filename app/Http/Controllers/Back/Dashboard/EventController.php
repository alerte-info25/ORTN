<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\Newsletter\NewsLetterMail;
use App\Models\Event;
use App\Models\NewsLetterAbonne;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Affiche la liste des événements
    */

    public function liste()
    {
        $now = Carbon::now();

        // On récupère les events avec le nombre de participants
        $events = Event::withCount('participants')
            ->latest()
            ->paginate(10);

        // Événements à venir
        $upcoming = Event::where(function($q) use ($now) {
            $q->whereDate('start_date', '>', $now->toDateString())
            ->orWhere(function($q2) use ($now) {
                $q2->whereDate('start_date', $now->toDateString())
                    ->whereTime('start_time', '>', $now->toTimeString());
            });
        })->count();

        // Événements en cours
        $ongoing = Event::where(function($q) use ($now) {
            $q->whereDate('start_date', '<=', $now->toDateString())
            ->whereDate('end_date', '>=', $now->toDateString())
            ->where(function($q2) use ($now) {
                $q2->whereTime('start_time', '<=', $now->toTimeString())
                    ->whereTime('end_time', '>=', $now->toTimeString());
            });
        })->count();

        // Événements passés
        $past = Event::where(function($q) use ($now) {
            $q->whereDate('end_date', '<', $now->toDateString())
            ->orWhere(function($q2) use ($now) {
                $q2->whereDate('end_date', $now->toDateString())
                    ->whereTime('end_time', '<', $now->toTimeString());
            });
        })->count();

        return view('back.events.liste', compact('events', 'upcoming', 'ongoing', 'past'));
    }

    /**
     * Affiche le formulaire de création d’un événement
    */
    public function create()
    {
        return view('back.events.index');
    }

    /**
     * Enregistre un nouvel événement
     */
    public function store(Request $request)
    {
        // Validation des champs
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'category' => 'required|string|max:100',

            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required',

            'format' => 'nullable|in:online,hybride',
            'venue' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'online_url' => 'nullable|url',

            'organizer' => 'required|string|max:255',
            'organizer_email' => 'nullable|email|max:255',
            'organizer_phone' => 'nullable|string|max:30',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'capacity' => 'nullable|integer|min:1',
            'access_type' => 'required|in:free,paid',
            'price' => 'nullable|numeric|min:0',
            'requires_registration' => 'nullable|boolean',
            'registration_url' => 'nullable|url',
        ]);

        // Ajout manuel de l’utilisateur connecté
        $validated['user_id'] = Auth::id();

        // Gestion de l’image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        // Normalisation : si gratuit, pas de prix
        if ($validated['access_type'] === 'free') {
            $validated['price'] = null;
        }

        // Booléen de l’inscription
        $validated['requires_registration'] = $request->has('requires_registration');

        // Slug unique
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        // Enregistrement
        $event = Event::create($validated);

        return redirect()->route('dashboard.events.show', $event->id)
            ->with('alert', [
                'type' => 'success',
                'message' => 'Événement créé avec succès'
            ]);
    }

    /**
     * Affiche un événement spécifique
    */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('back.events.show', compact('event'));
    }


    /**
     * Supprime un événement
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Suppression de l'image
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('dashboard.events.liste')
            ->with('alert', [
                'type' => 'success',
                'message' => 'Événement supprimé avec succès'
            ]);
    }
}
