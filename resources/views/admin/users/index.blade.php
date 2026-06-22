<x-admin-layout>

    <x-slot name="title">
        Usuarios
    </x-slot>

    <x-alert type="success" />
    <x-alert type="error" />

    <x-admin.table>

        <!-- HEADER -->
        <x-slot name="header">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Lista de usuarios
            </h2>

            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 bg-green-600 hover:bg-green-700 transition
                      text-white rounded-lg text-sm font-medium">
                + Crear usuario
            </a>

        </x-slot>

        <!-- TABLE -->
        <table class="w-full">

            <thead class="bg-gray-50 dark:bg-gray-700">

                <tr>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Nombre
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Email
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Estado
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Registro
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Rol
                    </th>

                    <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">

                        <td class="px-6 py-4 text-gray-800 dark:text-gray-100">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                Activo
                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 text-sm">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <x-role-badge :role="$user->role" />
                        </td>

                        <td class="px-6 py-4">

                            <x-admin.action-group
                                :show="route('admin.users.show', $user)"
                                :edit="auth()->user()->role === 'admin'
                                    ? route('admin.users.edit', $user)
                                    : null"
                                :delete="auth()->user()->role === 'admin'
                                    ? route('admin.users.destroy', $user)
                                    : null"
                            />

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </x-admin.table>

</x-admin-layout>