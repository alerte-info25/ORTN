<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Affiche les participants d’un événement
    */
    public function showByEvent(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $query = $event->participants()->withPivot('status', 'registered_at');

        if ($request->filled('date')) {
            $query->wherePivot('registered_at', 'like', $request->date . '%');
        }

        $participants = $query->paginate(10);

        return view('back.participants.event', compact('event', 'participants'));
    }
}
