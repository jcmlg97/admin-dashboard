<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>
        {{ $title ?? config('app.name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">

    <!-- NAV -->
    <header class="w-full border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

            <div class="font-bold text-lg">
                Sistema SaaS
            </div>

            <nav class="flex items-center gap-4 text-sm">
                <a href="/" class="hover:text-blue-500">Inicio</a>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Entrar
                </a>
            </nav>

        </div>
    </header>

    <!-- CONTENT -->
    <main>
        {{ $slot }}
    </main>

</body>

</html>