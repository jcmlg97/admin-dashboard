<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where(function ($query) {
                $query->where('visibility', 'public')
                    ->orWhere('user_id', Auth::id());
            })
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->get()
            ->map(function ($event) {

                $eventDate = Carbon::parse($event->start_date);

                $days = (int) now()->startOfDay()
                    ->diffInDays($eventDate->startOfDay());

                $event->label = match (true) {
                    $days === 0 => 'Hoy',
                    $days === 1 => 'Mañana',
                    $days > 1 => "Faltan {$days} días",
                    default => 'Finalizado',
                };

                return $event;
            });

        return view('user.events.index', compact('events'));
    }
}