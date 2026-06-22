@props(['action'])

<div x-data="{ open: false }" x-cloak>
    
    <!-- BUTTON -->
    <button type="button"
            @click="open = true"
            class="px-3 py-1 rounded-lg text-sm bg-red-100 text-red-700 hover:bg-red-200
                   dark:bg-red-900 dark:text-red-300">
        Eliminar
    </button>

    <!-- MODAL -->
    <div x-show="open" x-transition
         class="fixed inset-0 bg-black/50 flex items-center justify-center">

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl w-96">

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                Confirmar eliminación
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                ¿Seguro que deseas eliminar este elemento?
            </p>

            <div class="flex justify-end gap-3 mt-6">

                <button @click="open = false"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded">
                    Cancelar
                </button>

                <form method="POST" :action="'{{ $action }}'">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded">
                        Eliminar
                    </button>

                </form>

            </div>

        </div>
    </div>

</div>