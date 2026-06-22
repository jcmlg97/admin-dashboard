<x-landing-layout>
<x-slot name="title">
    Sistema de gestión
</x-slot>
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">

    <!-- HERO -->
    <div class="max-w-6xl mx-auto px-6 py-24 text-center">

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white">
            Plataforma de gestión administrativa
        </h1>

        <p class="mt-4 text-gray-600 dark:text-gray-300">
            Administra usuarios, eventos, productos y actividad desde una única plataforma centralizada.
        </p>

        <a href="{{ route('login') }}"
           class="mt-8 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Acceder al sistema
        </a>

    </div>

    <!-- FEATURES -->
    <div class="max-w-6xl mx-auto px-6 pb-24 grid md:grid-cols-3 gap-6">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="font-semibold text-gray-900 dark:text-white">Usuarios</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                Gestión completa de usuarios y roles.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="font-semibold text-gray-900 dark:text-white">Eventos</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                Calendario interactivo con FullCalendar.
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="font-semibold text-gray-900 dark:text-white">Dashboard</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                Métricas y actividad en tiempo real.
            </p>
        </div>

    </div>

</div>

</x-landing-layout>