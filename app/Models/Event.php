<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'type',
        'status',
        'color',
        'all_day',
        'user_id',
        'visibility',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'active' => ['class' => 'bg-green-100 text-green-700', 'text' => 'Activo'],
            'cancelled' => ['class' => 'bg-red-100 text-red-700', 'text' => 'Cancelado'],
            'finished' => ['class' => 'bg-gray-100 text-gray-700', 'text' => 'Finalizado'],
            default => ['class' => 'bg-blue-100 text-blue-700', 'text' => 'Activo'],
        };
    }
}