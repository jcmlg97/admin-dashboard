<x-auth-layout>
<x-slot name="title">
    Login
</x-slot>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-6">

    <div class="w-full max-w-6xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden grid md:grid-cols-2">

        <!-- LEFT -->
        <div class="hidden md:flex flex-col justify-center p-14 bg-gradient-to-br from-gray-900 to-gray-800 text-white">

            <h1 class="text-4xl font-bold">
                Sistema de gestión
            </h1>

            <p class="mt-4 text-gray-300">
                Panel de administración de usuarios, eventos y recursos.
            </p>

            <div class="mt-8 text-sm text-gray-400">
                Accede con tu cuenta para continuar
            </div>

        </div>

        <!-- RIGHT -->
        <div class="p-10 md:p-14">

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                Iniciar sesión
            </h2>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        required autofocus />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required />
                </div>

                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                        <input type="checkbox" name="remember"
                               class="rounded border-gray-300 dark:bg-gray-900">
                        Recordarme
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-200">
                            ¿Olvidaste la contraseña?
                        </a>
                    @endif

                </div>

                <x-primary-button class="w-full justify-center py-3">
                    Entrar
                </x-primary-button>

            </form>

        </div>

    </div>

</div>

</x-auth-layout>