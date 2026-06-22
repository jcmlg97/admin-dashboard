<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $nextEvent = Event::where(function ($query) {
                $query->where('visibility', 'public')
                    ->orWhere('user_id', Auth::id());
            })
            ->whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->first();

        if ($nextEvent) {

            $eventDate = Carbon::parse($nextEvent->start_date);

            $days = (int) now()
                ->startOfDay()
                ->diffInDays($eventDate->startOfDay());

            $nextEvent->label = match (true) {
                $days === 0 => 'Hoy',
                $days === 1 => 'Mañana',
                $days > 1 => "Faltan {$days} días",
                default => 'Hoy',
            };
        }

        return view('user.dashboard', [
            'user' => Auth::user(),
            'activities' => ActivityLog::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get(),
            'nextEvent' => $nextEvent,
        ]);
    }
}