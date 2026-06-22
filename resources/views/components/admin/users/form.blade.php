@props(['user' => null])

<div class="space-y-6">

    <!-- NAME -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Nombre
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
            required
            autocomplete="name"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white
                   focus:ring-2 focus:ring-blue-200">

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- EMAIL -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            required
            autocomplete="email"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white
                   focus:ring-2 focus:ring-blue-200">

        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- PASSWORD -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Contraseña
        </label>

        <input
            type="password"
            name="password"
            autocomplete="new-password"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white
                   focus:ring-2 focus:ring-blue-200">

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            {{ $user
                ? 'Déjalo vacío si no quieres cambiar la contraseña'
                : 'Mínimo 6 caracteres' }}
        </p>

        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- CONFIRM PASSWORD -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Confirmar contraseña
        </label>

        <input
            type="password"
            name="password_confirmation"
            autocomplete="new-password"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white
                   focus:ring-2 focus:ring-blue-200">
    </div>

    <!-- ROLE -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Rol
        </label>

        <select
            name="role"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white
                   focus:ring-2 focus:ring-blue-200">

            <option value="user"
                @selected(old('role', $user->role ?? '') === 'user')>
                Usuario
            </option>

            <option value="admin"
                @selected(old('role', $user->role ?? '') === 'admin')>
                Administrador
            </option>

        </select>
    </div>

</div>