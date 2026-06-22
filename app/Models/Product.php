<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'name',
        'slug',
        'description',
        'price',
        'stock',
        'status',
        'image',

    ];

    protected $casts = [

        'price' => 'decimal:2',
        'stock' => 'integer',

    ];

        public function activities()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS
    |--------------------------------------------------------------------------
    */

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        return asset('images/default-product.png');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {

            'active' => [
                'text' => 'Activo',
                'class' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
            ],

            'inactive' => [
                'text' => 'Inactivo',
                'class' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
            ],

            default => [
                'text' => 'Borrador',
                'class' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
            ],
        };
    }
}