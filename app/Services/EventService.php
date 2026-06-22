<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function colorFromType(?string $type): string
    {
        return match ($type) {
            'meeting' => '#3b82f6',
            'course' => '#10b981',
            'event' => '#8b5cf6',
            'task' => '#f59e0b',
            'appointment' => '#ec4899',
            'travel' => '#f97316',
            'important' => '#ef4444',
            default => '#6b7280',
        };
    }

    public function toCalendarArray(Event $event): array
    {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start_date,
            'end' => $event->end_date,
            'description' => $event->description,
            'color' => $event->color,
            'type' => $event->type,
            'visibility' => $event->visibility,
        ];
    }
}