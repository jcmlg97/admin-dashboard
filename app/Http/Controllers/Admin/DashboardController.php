<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Event;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $nextEvents = Event::whereDate('start_date', '>=', now()->toDateString())
            ->orderBy('start_date')
            ->take(5)
            ->get()
            ->map(function ($event) {

                $eventDate = \Carbon\Carbon::parse($event->start_date);

                $days = (int) now()
                    ->startOfDay()
                    ->diffInDays($eventDate->startOfDay());

                $event->label = match (true) {
                    $days === 0 => 'Hoy',
                    $days === 1 => 'Mañana',
                    $days > 1 => "Faltan {$days} días",
                    default => "Faltan 0 días",
                };

                return $event;
            });

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalNormal' => User::where('role', 'user')->count(),
            'activities' => ActivityLog::latest()->take(5)->get(),
            'nextEvents' => $nextEvents,
        ]);
    }
}