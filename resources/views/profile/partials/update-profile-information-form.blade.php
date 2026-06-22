<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
            Información del perfil
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Actualiza tus datos personales y correo electrónico.
        </p>
    </header>

    <!-- FORM VERIFICACIÓN -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- FORM PRINCIPAL -->
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <!-- NAME -->
        <div>
            <label class="block mb-1 text-sm text-gray-700 dark:text-gray-300">
                Nombre
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 rounded-lg border
                       dark:bg-gray-900 dark:border-gray-700 dark:text-white"
                required
                autofocus>

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block mb-1 text-sm text-gray-700 dark:text-gray-300">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 rounded-lg border
                       dark:bg-gray-900 dark:border-gray-700 dark:text-white"
                required>

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- EMAIL NO VERIFICADO -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 text-sm text-gray-500 dark:text-gray-400">

                    <p>
                        Tu email no está verificado.
                    </p>

                    <button
                        form="send-verification"
                        class="underline text-sm text-blue-600 hover:text-blue-700">
                        Reenviar email de verificación
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-green-500">
                            Se ha enviado un nuevo enlace de verificación.
                        </p>
                    @endif

                </div>

            @endif
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4">

            <button type="submit"
                    class="px-4 py-2 rounded-lg text-sm
                           bg-blue-600 text-white hover:bg-blue-700 transition">
                Guardar cambios
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-sm text-green-500">
                    Guardado correctamente
                </span>
            @endif

        </div>

    </form>

</section>