@props(['type' => 'success'])

@php
    $classes = match($type) {
        'success' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-200',
        'error' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200',
        default => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-200',
    };
@endphp

@if(session($type))
    <div class="mb-4 p-4 rounded-lg {{ $classes }}">
        {{ session($type) }}
    </div>
@endif