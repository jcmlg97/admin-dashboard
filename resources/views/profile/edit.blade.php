<x-admin-layout>

    <x-slot name="title">
        Perfil
    </x-slot>

    <!-- NAVEGACIÓN RÁPIDA -->
<!-- NAVEGACIÓN RÁPIDA -->
<div class="sticky top-0 z-10 bg-gray-100 dark:bg-gray-900 py-3 mb-6 flex gap-4 text-sm border-b border-gray-200 dark:border-gray-700">

    <a href="#info" class="text-blue-600 hover:underline">
        Información
    </a>

    <a href="#security" class="text-blue-600 hover:underline">
        Seguridad
    </a>

    <a href="#danger" class="text-red-600 hover:underline">
        Zona peligrosa
    </a>

</div>

    <div class="max-w-4xl space-y-6">

        <!-- INFO -->
        <div id="info" class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- PASSWORD -->
        <div id="security" class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            @include('profile.partials.update-password-form')
        </div>

        <!-- DELETE -->
        <div id="danger" class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

</x-admin-layout>