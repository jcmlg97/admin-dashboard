<x-admin-layout>

    <x-slot name="title">
        Usuario
    </x-slot>

    <div class="max-w-3xl mx-auto">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow">

            <!-- HEADER PERFIL -->
            <div class="p-6 border-b dark:border-gray-700 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <!-- AVATAR -->
                    <div class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <span class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            {{ $user->name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $user->email }}
                        </p>
                    </div>

                </div>

                <div class="flex items-center gap-3">
                    <x-role-badge :role="$user->role" />
                    <span class="text-xs text-gray-500">#{{ $user->id }}</span>
                </div>

            </div>

            <!-- BODY INFO -->
            <div class="p-6 space-y-4">

                <div class="flex justify-between border-b dark:border-gray-700 pb-2">
                    <span class="text-gray-600 dark:text-gray-300">Creado</span>
                    <span class="text-gray-800 dark:text-gray-200">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <div class="flex justify-between border-b dark:border-gray-700 pb-2">
                    <span class="text-gray-600 dark:text-gray-300">Última actualización</span>
                    <span class="text-gray-800 dark:text-gray-200">
                        {{ $user->updated_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <!-- 🆕 ÚLTIMA ACTIVIDAD -->
                <div class="flex justify-between border-b dark:border-gray-700 pb-2">
                    <span class="text-gray-600 dark:text-gray-300">Última actividad</span>

                    <span class="text-gray-800 dark:text-gray-200 text-right text-sm">
                        {{ optional($user->activities->first())->description ?? 'Sin actividad' }}
                    </span>
                </div>

            </div>

            <!-- ACTIONS -->
            <div class="p-6 flex justify-end gap-3">

                <x-admin.action-group
                    :edit="route('admin.users.edit', $user)"
                    :delete="route('admin.users.destroy', $user)"
                />

            </div>

        </div>

    </div>

</x-admin-layout>