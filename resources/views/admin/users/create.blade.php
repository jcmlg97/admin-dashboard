<x-admin-layout>

    <x-slot name="title">
        Crear usuario
    </x-slot>

    <div class="max-w-3xl">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow">

            <div class="p-6 border-b dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                    Nuevo usuario
                </h2>
            </div>

            <form method="POST"
                  action="{{ route('admin.users.store') }}"
                  class="p-6 space-y-6">

                @csrf

                <x-admin.users.form :user="$user ?? null" />
                
                <!-- BUTTONS -->
                <div class="flex justify-end gap-3">

                    <a href="{{ route('admin.users.index') }}"
                       class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700
                              text-gray-700 dark:text-white">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700
                               text-white font-medium transition">
                        Crear usuario
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-admin-layout>