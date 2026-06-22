{{-- resources/views/admin/products/create.blade.php --}}

<x-admin-layout>

    <x-slot name="title">
        Crear producto
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
                            Nuevo producto
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Añade un nuevo producto al catálogo.
                        </p>
                    </div>

                    <span class="px-3 py-1 rounded-full text-xs
                                 bg-green-100 text-green-700
                                 dark:bg-green-900 dark:text-green-300">
                        Creación
                    </span>

                </div>

            </div>

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('admin.products.store') }}"
                  class="p-6 space-y-6">

                @csrf

                <x-admin.products.form :product="$product ?? null" />
                
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
                                   bg-green-600 hover:bg-green-700
                                   text-white font-medium
                                   transition text-sm">

                        Crear producto

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-admin-layout>