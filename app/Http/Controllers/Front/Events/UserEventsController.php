<?php

namespace App\Http\Controllers\Front\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserEventsController extends Controller
{

    public function getData()
    {
        $today = \Carbon\Carbon::today();

        $todayEvent = Event::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderBy('start_date')
            ->first();

        $ongoingEvents = Event::whereDate('start_date', '<', $today)
            ->whereDate('end_date', '>', $today)
            ->orderBy('start_date')
            ->paginate(6, ['*'], 'ongoing_page');

        $upcomingEvents = Event::whereDate('start_date', '>', $today)
            ->orderBy('start_date')
            ->paginate(6, ['*'], 'upcoming_page');

        return compact('todayEvent', 'ongoingEvents', 'upcomingEvents');
    }

    public function index ()
    {
        return view('Front.Evenements.index', $this->getData());
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $category = $event->category;

        $similares = Event::where('category', $category)
            ->where('id', '!=', $event->id)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        return view("Front.Evenements.detail-event", compact('event', 'similares'));
    }

}
