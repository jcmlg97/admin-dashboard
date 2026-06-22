<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>
        {{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}
    </title>

    <script>
        (function () {
            const html = document.documentElement;
            const theme = localStorage.getItem('theme');

            if (theme === 'light') {
                html.classList.remove('dark');
            } else {
                html.classList.add('dark');
            }
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    <!-- OVERLAY MOBILE -->
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/50 z-40 md:hidden"
        style="display:none;">
    </div>

    @php
        $isAdmin = auth()->user()->role === 'admin';
    @endphp

    <!-- SIDEBAR -->
    <aside
        class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-lg
               transform transition-transform duration-300
               md:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        <!-- HEADER SIDEBAR -->
        <div class="p-4 border-b dark:border-gray-700">
            <div class="flex items-center justify-between">

                <span class="text-xl font-bold text-gray-800 dark:text-white">
                    {{ config('app.name') }}
                </span>

                <button
                    @click="sidebarOpen = false"
                    class="md:hidden text-gray-500 dark:text-gray-300">

                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>

            </div>
        </div>

        <!-- NAV -->
        <nav class="mt-4 space-y-1 px-2">

            <!-- DASHBOARD -->
            <a href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium
               text-gray-700 dark:text-gray-200
               transition hover:bg-gray-100 dark:hover:bg-gray-700
               {{ str_contains(request()->path(), 'dashboard') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">

                <span class="flex items-center gap-2">
                    <x-heroicon-o-chart-bar class="w-5 h-5" />
                    Dashboard
                </span>
            </a>

            @if($isAdmin)

                <!-- USERS -->
                <a href="{{ route('admin.users.index') }}"
                   class="block px-3 py-2 rounded-md text-sm font-medium
                   text-gray-700 dark:text-gray-200
                   transition hover:bg-gray-100 dark:hover:bg-gray-700
                   {{ str_contains(request()->path(), 'users') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">

                    <span class="flex items-center gap-2">
                        <x-heroicon-o-users class="w-5 h-5" />
                        Usuarios
                    </span>
                </a>

                <!-- PRODUCTS -->
                <a href="/admin/products"
                   class="block px-3 py-2 rounded-md text-sm font-medium
                   text-gray-700 dark:text-gray-200
                   transition hover:bg-gray-100 dark:hover:bg-gray-700
                   {{ str_contains(request()->path(), 'products') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">

                    <span class="flex items-center gap-2">
                        <x-heroicon-o-cube class="w-5 h-5" />
                        Productos
                    </span>
                </a>

            @endif

            <!-- EVENTS -->
            <a href="{{ $isAdmin ? route('admin.events.index') : route('user.events.index') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium
               text-gray-700 dark:text-gray-200
               transition hover:bg-gray-100 dark:hover:bg-gray-700
               {{ str_contains(request()->path(), 'events') ? 'bg-gray-200 dark:bg-gray-700' : '' }}">

                <span class="flex items-center gap-2">
                    <x-heroicon-o-calendar-days class="w-5 h-5" />
                    Eventos
                </span>
            </a>

        </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 overflow-x-hidden">

        <!-- TOPBAR -->
        <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex items-center justify-between">

            <div class="flex items-center gap-3">

                <!-- HAMBURGER -->
                <button
                    @click="sidebarOpen = true"
                    class="md:hidden text-gray-700 dark:text-gray-200">

                    <x-heroicon-o-bars-3 class="w-7 h-7" />
                </button>

                <h1 class="text-gray-800 dark:text-white font-semibold">
                    {{ $title ?? config('app.name') }}
                </h1>

            </div>

            <!-- USER -->
            <x-dropdown align="right" width="48">

                <x-slot name="trigger">
                    <button class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200">
                        <span>{{ Auth::user()->name }}</span>

                        @php
                            $role = Auth::user()->role;
                        @endphp

                        <span class="text-xs px-2 py-0.5 rounded
                            {{ $role === 'admin' ? 'bg-red-500 text-white' : 'bg-blue-500 text-white' }}">
                            {{ $role }}
                        </span>

                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">

                    <x-dropdown-link href="/profile">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-user class="w-4 h-4" />
                            Perfil
                        </span>
                    </x-dropdown-link>

                    <!-- THEME -->
                    <button
                        onclick="toggleTheme()"
                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">

                        <span id="themeIcon">🌓</span> Cambiar tema
                    </button>

                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                    <!-- LOGOUT -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">

                            <span class="flex items-center gap-2">
                                <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4" />
                                Cerrar sesión
                            </span>

                        </x-dropdown-link>
                    </form>

                </x-slot>

            </x-dropdown>

        </header>

        <!-- CONTENT -->
        <main class="p-6">
            {{ $slot ?? '' }}
        </main>

    </div>

</div>

</body>
</html>