<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
            Cambiar contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Usa una contraseña segura y única para tu cuenta.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- CURRENT PASSWORD -->
        <div>
            <label class="block mb-1 text-sm text-gray-700 dark:text-gray-300">
                Contraseña actual
            </label>

            <input
                type="password"
                name="current_password"
                class="w-full px-4 py-2 rounded-lg border
                       dark:bg-gray-900 dark:border-gray-700 dark:text-white">

            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- NEW PASSWORD -->
        <div>
            <label class="block mb-1 text-sm text-gray-700 dark:text-gray-300">
                Nueva contraseña
            </label>

            <input
                type="password"
                name="password"
                class="w-full px-4 py-2 rounded-lg border
                       dark:bg-gray-900 dark:border-gray-700 dark:text-white">

            @error('password', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- CONFIRM PASSWORD -->
        <div>
            <label class="block mb-1 text-sm text-gray-700 dark:text-gray-300">
                Confirmar contraseña
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full px-4 py-2 rounded-lg border
                       dark:bg-gray-900 dark:border-gray-700 dark:text-white">

            @error('password_confirmation', 'updatePassword')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4">

            <button type="submit"
                    class="px-4 py-2 rounded-lg text-sm
                           bg-blue-600 text-white hover:bg-blue-700 transition">
                Guardar cambios
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-sm text-green-500">
                    Guardado correctamente
                </span>
            @endif

        </div>

    </form>

</section>