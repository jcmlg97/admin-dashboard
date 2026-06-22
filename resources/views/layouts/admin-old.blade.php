<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg hidden md:block">
        <div class="p-4 text-xl font-bold text-gray-800 dark:text-white">
            Admin Panel
        </div>

        <nav class="mt-6">
            <a href="/admin/dashboard" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                Dashboard
            </a>

            <a href="/admin/users" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                Usuarios
            </a>

            <a href="/admin/products" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                Productos
            </a>

            <a href="/admin/events" class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700">
                Eventos
            </a>
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1">

        <!-- TOPBAR -->
        <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between">
            <h1 class="text-gray-800 dark:text-white font-semibold">
                @yield('title', 'Dashboard')
            </h1>

            <!-- aquí luego metemos usuario + toggle -->
        </header>

        <!-- CONTENT -->
        <main class="p-6">
            {{ $slot ?? '' }}
        </main>

    </div>

</div>

</body>
</html>