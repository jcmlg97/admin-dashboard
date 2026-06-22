<x-admin-layout>

    <x-slot name="title">
        Mi Dashboard
    </x-slot>

    <!-- BIENVENIDA -->
    <div class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-6">

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Bienvenido, {{ auth()->user()->name }}
        </h2>

        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Este es tu panel personal. Aquí puedes ver tu actividad y datos básicos.
        </p>

    </div>

    <!-- CARDS USER -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- ROL -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Rol de usuario
            </p>

            <h2 class="text-2xl font-bold text-blue-600 mt-2">
                {{ ucfirst(auth()->user()->role) }}
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Permisos asignados en el sistema
            </p>

        </div>

        <!-- FECHA REGISTRO -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Mi cuenta
            </p>

            <h2 class="text-lg font-bold text-gray-800 dark:text-white mt-2">
                {{ auth()->user()->created_at->format('d/m/Y') }}
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Fecha de registro
            </p>

        </div>

    </div>

    <!-- ACTIVIDAD PERSONAL -->
    <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow p-6">

        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
            Mi actividad reciente
        </h3>

        <div class="space-y-3">

            @forelse($activities as $activity)

                <div class="flex justify-between border-b dark:border-gray-700 pb-2">

                    <div class="text-gray-700 dark:text-gray-300">
                        {{ $activity->description ?? $activity->action }}
                    </div>

                    <div class="text-sm text-gray-500">
                        {{ $activity->created_at->diffForHumans() }}
                    </div>

                </div>

            @empty

                <p class="text-gray-500">
                    No tienes actividad aún
                </p>

            @endforelse

        </div>

    </div>

    @if($nextEvent)

    <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow p-6">

        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
            Próximo evento
        </h3>

        <div class="flex items-start gap-3">

            <div
                class="w-3 h-3 rounded-full mt-2"
                style="background-color: {{ $nextEvent->color ?? '#6b7280' }}">
            </div>

            <div>

                <p class="font-medium text-gray-800 dark:text-white">
                    {{ $nextEvent->title }}
                </p>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $nextEvent->label }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ \Carbon\Carbon::parse($nextEvent->start_date)->format('d/m/Y H:i') }}
                </p>

            </div>

        </div>

        <div class="mt-4">
            <a href="{{ route('user.events.index') }}"
            class="text-sm text-blue-600 hover:text-blue-700">
                Ver todos los eventos →
            </a>
        </div>

    </div>

    @endif

</x-admin-layout>