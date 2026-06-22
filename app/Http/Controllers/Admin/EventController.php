<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\EventService;

class EventController extends Controller
{

    public function __construct(
        protected EventService $eventService
    ) {}

    /**
     * Página del calendario
     */
    public function index()
    {
        return view('admin.events.index');
    }

    /**
     * API: devolver eventos en formato FullCalendar
     */
    public function fetch()
    {
        return response()->json(
            Event::all()->map(fn($event) =>
                $this->eventService->toCalendarArray($event)
            )
        );
    }

    /**
     * Crear evento
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'visibility' => 'nullable|string',
        ]);

        $color = $this->eventService->colorFromType($data['type'] ?? null);

        $event = Event::create([
            'title' => $data['title'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end'] ?? null,
            'description' => $data['description'] ?? null,
            'type' => $data['type'] ?? 'event',
            'color' => $color,
            'visibility' => $data['visibility'] ?? 'personal',
            'user_id' => Auth::id(),
        ]);

        log_activity('created_event', "Evento creado: {$event->title}");

        return response()->json($event);
    }

    /**
     * Actualizar evento (drag & drop o edición)
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'start_date' => 'sometimes|date',
            'description' => 'nullable|string',
            'end' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|string',
            'visibility' => 'nullable|string',
        ]);

        $type = $data['type'] ?? $event->type;
        $color = $this->eventService->colorFromType($type);

        $event->update([
            'title' => $data['title'] ?? $event->title,
            'start_date' => $data['start_date'] ?? $event->start_date,
            'end_date' => $data['end'] ?? $event->end_date,
            'description' => $data['description'] ?? $event->description,
            'type' => $type,
            'visibility' => $data['visibility'] ?? $event->visibility,
            'color' => $color,
        ]);

        log_activity('updated_event', "Evento actualizado: {$event->title}");

        return response()->json($event);
    }

    /**
     * Eliminar evento
     */
    public function destroy(Event $event)
    {
        log_activity('deleted_event', "Evento eliminado: {$event->title}");

        $event->delete();

        return response()->json(['success' => true]);
    }
}