<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
            Eliminar cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Una vez eliminada la cuenta, todos sus datos se borrarán permanentemente.
        </p>
    </header>

    <!-- BOTÓN -->
    <button
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 rounded-lg text-sm
               bg-red-600 text-white hover:bg-red-700 transition">
        Eliminar cuenta
    </button>

    <!-- MODAL -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                ¿Seguro que quieres eliminar tu cuenta?
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Esta acción no se puede deshacer.
            </p>

            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Contraseña"
                    class="w-full px-4 py-2 rounded-lg border
                           dark:bg-gray-900 dark:border-gray-700 dark:text-white">
            </div>

            <div class="flex justify-end gap-3">

                <button type="button"
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 rounded-lg text-sm
                               bg-gray-200 dark:bg-gray-700">
                    Cancelar
                </button>

                <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm
                               bg-red-600 text-white hover:bg-red-700">
                    Eliminar
                </button>

            </div>

        </form>

    </x-modal>

</section>