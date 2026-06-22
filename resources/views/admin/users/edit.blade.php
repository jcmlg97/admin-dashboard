<x-admin-layout>

    <x-slot name="title">
        Editar usuario
    </x-slot>

    <div class="max-w-3xl">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow">

            <!-- HEADER DEL CARD -->
            <div class="p-6 border-b dark:border-gray-700">

                <div class="flex items-center gap-3">

                    <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700"></div>

                    <div>
                        <div class="text-sm font-semibold text-gray-800 dark:text-white">
                            {{ $user->name }}
                        </div>

                        <div class="text-xs text-gray-500">
                            {{ $user->email }}
                        </div>
                    </div>

                    <x-role-badge :role="$user->role" />

                </div>

            </div>

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('admin.users.update', $user) }}"
                  class="p-6 space-y-6">

                @csrf
                @method('PUT')

                <x-admin.users.form :user="$user ?? null" />

                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.users.index') }}"
                       class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700
                              text-gray-700 dark:text-white">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-lg bg-yellow-600 hover:bg-yellow-700
                               text-white font-medium transition">
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-admin-layout>