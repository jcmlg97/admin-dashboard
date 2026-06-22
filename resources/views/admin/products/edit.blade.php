<x-admin-layout>

    <x-slot name="title">
        Editar producto
    </x-slot>

    <x-alert type="success" />
    <x-alert type="error" />

    <div class="max-w-4xl">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

            <!-- HEADER -->
            <div class="p-6 border-b dark:border-gray-700">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                            Editar producto
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Modifica la información del producto.
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-xs
                                 bg-yellow-100 text-yellow-700
                                 dark:bg-yellow-900 dark:text-yellow-300">
                        Edición
                    </span>

                </div>

            </div>

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('admin.products.update', $product) }}"
                  enctype="multipart/form-data"
                  class="p-6 space-y-6">

                @csrf
                @method('PUT')

                <x-admin.products.form :product="$product" />

                <!-- BUTTONS -->
                <div class="flex justify-end gap-3 pt-4 border-t dark:border-gray-700">

                    <a href="{{ route('admin.products.index') }}"
                       class="px-4 py-2 rounded-lg
                              bg-gray-200 hover:bg-gray-300
                              dark:bg-gray-700 dark:hover:bg-gray-600
                              text-gray-700 dark:text-white
                              transition text-sm font-medium">

                        Cancelar

                    </a>

                    <button type="submit"
                            class="px-5 py-2 rounded-lg
                                   bg-yellow-600 hover:bg-yellow-700
                                   text-white font-medium
                                   transition text-sm">

                        Guardar cambios

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-admin-layout>