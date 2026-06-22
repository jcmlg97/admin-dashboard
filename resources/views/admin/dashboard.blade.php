<x-admin-layout>

    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Usuarios</p>

            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                {{ $totalUsers }}
            </h2>

            <p class="text-green-500 text-sm mt-2">
                Total registrados
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Admins</p>

            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                {{ $totalAdmins }}
            </h2>

            <p class="text-blue-500 text-sm mt-2">
                Con permisos de gestión
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Usuarios normales</p>

            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                {{ $totalNormal }}
            </h2>

            <p class="text-yellow-500 text-sm mt-2">
                Sin permisos admin
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">
            <p class="text-sm text-gray-500 dark:text-gray-400">Sistema</p>

            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                OK
            </h2>

            <p class="text-green-500 text-sm mt-2">
                Funcionando correctamente
            </p>
        </div>

    </div>

    <!-- ACTIVIDAD + PRÓXIMOS EVENTOS -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

        <!-- ACTIVIDAD -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                Actividad reciente
            </h3>

            <div class="space-y-3">

                @forelse($activities as $activity)

                    <div class="flex justify-between border-b dark:border-gray-700 pb-2">

                        <div class="text-gray-700 dark:text-gray-300">
                            {{ $activity->description ?? $activity->action }}
                        </div>

                        <div class="text-sm text-gray-500 whitespace-nowrap ml-4">
                            {{ $activity->created_at->diffForHumans() }}
                        </div>

                    </div>

                @empty

                    <p class="text-gray-500 dark:text-gray-400">
                        No hay actividad aún
                    </p>

                @endforelse

            </div>

        </div>
        
        <!-- PRÓXIMOS EVENTOS -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                Próximos eventos
            </h3>

            @forelse($nextEvents as $event)

                <div class="flex items-start gap-3 py-3 border-b border-gray-200 dark:border-gray-700 last:border-0">

                    <!-- punto de color (categoría) -->
                    <div
                        class="w-3 h-3 rounded-full mt-2 flex-shrink-0"
                        style="background-color: {{ $event->color ?? '#6b7280' }}">
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center justify-between gap-2">

                            <p class="font-medium text-gray-800 dark:text-white">
                                {{ $event->title }}
                            </p>

                            {{-- BADGE SOLO PARA HOY --}}
                            @if($event->label === 'Hoy')
                                <span class="px-2 py-0.5 text-[11px] font-semibold rounded-full bg-red-50 text-red-600 dark:bg-red-900/30 dark:text-red-300">
                                    Hoy
                                </span>
                            @endif

                        </div>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $event->label }}
                        </p>

                        <p class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                        </p>

                    </div>

                </div>

            @empty

                <p class="text-gray-500 dark:text-gray-400">
                    No hay eventos próximos.
                </p>

            @endforelse

        </div>
    </div>
    

</x-admin-layout>