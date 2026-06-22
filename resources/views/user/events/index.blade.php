<x-admin-layout>

    <x-slot name="title">
        Mis eventos
    </x-slot>

    <div class="max-w-5xl mx-auto py-2">

        <div class="mb-6">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Mis eventos
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $events->count() }} eventos disponibles
            </p>

        </div>

        <div class="space-y-4">

            @forelse($events as $event)

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-5">

                    <div class="flex items-start gap-3">

                        <!-- Color categoría -->
                        <div
                            class="w-3 h-3 rounded-full mt-2 flex-shrink-0"
                            style="background-color: {{ $event->color ?? '#6b7280' }}">
                        </div>

                        <div class="flex-1">

                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">

                                <div>

                                    <h3 class="font-semibold text-gray-800 dark:text-white">
                                        {{ $event->title }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                                    </p>

                                </div>

                                <div class="flex flex-wrap gap-2">

                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $event->label }}
                                    </p>

                                    {{-- TIPO --}}
                                    <span class="text-xs px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                        {{ ucfirst($event->type) }}
                                    </span>

                                </div>

                            </div>

                            @if($event->description)

                                <div class="mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">

                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                        {{ $event->description }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 text-center">

                    <p class="text-gray-500 dark:text-gray-400">
                        No tienes eventos asignados.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</x-admin-layout>