<x-admin-layout>

    <x-slot name="title">
        {{ $product->name }}
    </x-slot>

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- TOP SECTION -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2">

                <!-- IMAGE -->
                <div class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center p-6">

                    <img src="{{ $product->image_url }}"
                         class="w-full max-h-[400px] object-cover rounded-lg shadow">

                </div>

                <!-- INFO -->
                <div class="p-6 space-y-6">

                    <!-- TITLE + STATUS -->
                    <div class="flex items-start justify-between">

                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $product->name }}
                            </h1>

                            <p class="text-sm text-gray-500">
                                {{ $product->slug }}
                            </p>
                        </div>

                        <span class="px-3 py-1 text-xs rounded-full
                            {{ $product->status_badge['class'] }}">
                            {{ $product->status_badge['text'] }}
                        </span>

                    </div>

                    <!-- PRICE -->
                    <div>
                        <p class="text-sm text-gray-500">Precio</p>
                        <p class="text-3xl font-bold text-gray-800 dark:text-white">
                            €{{ number_format($product->price, 2) }}
                        </p>
                    </div>

                    <!-- STOCK -->
                    <div>
                        <p class="text-sm text-gray-500">
                            Stock disponible
                        </p>

                        <div class="flex items-center gap-3 mt-1">

                            <input type="number"
                                value="{{ $product->stock }}"
                                min="0"
                                class="w-24 rounded-lg
                                        text-xl font-semibold
                                        text-gray-800 dark:text-gray-100
                                        dark:bg-gray-900 dark:border-gray-700
                                        border-gray-300 text-center"
                                onchange="updateStock(this, {{ $product->id }})">

                            <span class="text-gray-500 dark:text-gray-400">
                                unidades
                            </span>

                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex gap-3 pt-4">

                        <x-admin.action-group
                            :edit="route('admin.products.edit', $product)"
                            :delete="route('admin.products.destroy', $product)"
                        />

                    </div>

                </div>

            </div>

        </div>

        <!-- DESCRIPTION -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">
                Descripción
            </h2>

            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ $product->description ?? 'Sin descripción' }}
            </p>

        </div>

        <!-- METADATA -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <p class="text-sm text-gray-500">ID</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    #{{ $product->id }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Creado</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $product->created_at->format('d/m/Y') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Última actualización</p>
                <p class="font-semibold text-gray-800 dark:text-white">
                    {{ $product->updated_at->format('d/m/Y') }}
                </p>
            </div>

        </div>

        <!-- ACTIVITY -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">

            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
                Última actividad
            </h2>

            @if($lastActivity)

                <div class="flex justify-between items-start border-b dark:border-gray-700 pb-3">

                    <div>
                        <p class="text-gray-700 dark:text-gray-300">
                            {{ $lastActivity->description }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Acción: {{ $lastActivity->action }}
                        </p>
                    </div>

                    <div class="text-sm text-gray-500 whitespace-nowrap">
                        {{ $lastActivity->created_at->diffForHumans() }}
                    </div>

                </div>

            @else
                <p class="text-gray-500">No hay actividad reciente</p>
            @endif

        </div>

    </div>

    <script>
    function updateStock(input, id) {

        input.classList.add('opacity-50');

        fetch(`/admin/products/${id}/stock`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ stock: input.value })
        })
        .finally(() => {
            input.classList.remove('opacity-50');
        });
    }
    </script>

</x-admin-layout>