<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $events = [
            [
                'title' => 'Reunión de Junta',
                'description' => 'Reunión mensual de planificación',
                'start_date' => Carbon::now()->addDays(2)->setTime(19, 0),
                'end_date' => Carbon::now()->addDays(2)->setTime(20, 30),
                'type' => 'reunion',
                'visibility' => 'personal',
                'color' => '#3b82f6',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Inventario',
                'description' => 'Realización de inventario',
                'start_date' => Carbon::now()->addDays(5)->setTime(20, 0),
                'end_date' => Carbon::now()->addDays(5)->setTime(21, 30),
                'type' => 'stock',
                'visibility' => 'public',
                'color' => '#8b5cf6',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Curso PRL',
                'description' => 'Curso de prevención de riesgos laborales',
                'start_date' => Carbon::now()->addDays(10)->setTime(18, 0),
                'end_date' => Carbon::now()->addDays(10)->setTime(21, 0),
                'type' => 'Curso',
                'visibility' => 'public',
                'color' => '#ef4444',
                'user_id' => $user->id,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}