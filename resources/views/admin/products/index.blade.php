<x-admin-layout>

    <x-slot name="title">
        Productos
    </x-slot>

    <x-alert type="success" />
    <x-alert type="error" />

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">

        <!-- HEADER -->
        <div class="p-6 border-b dark:border-gray-700 flex items-center justify-between">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Lista de productos
            </h2>

            <a href="{{ route('admin.products.create') }}"
               class="px-4 py-2 bg-green-600 hover:bg-green-700 transition text-white rounded-lg text-sm font-medium">
                + Crear producto
            </a>

        </div>

        <form method="GET" class="p-6 border-b dark:border-gray-700 flex flex-wrap gap-3">

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar producto..."
                class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-gray-800">

            <select name="status"
                    class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-gray-800">

                <option value="">Estado</option>
                <option value="active" @selected(request('status') === 'active')>Activo</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactivo</option>
                <option value="draft" @selected(request('status') === 'draft')>Borrador</option>
            </select>

        <select name="stock"
                class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 text-gray-800">

            <option value="">Stock</option>
            <option value="low" @selected(request('stock') === 'low')>
                Bajo (&lt;5)
            </option>
            <option value="out" @selected(request('stock') === 'out')>
                Agotado
            </option>

        </select>

            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                Filtrar
            </button>

            @if(request()->hasAny(['search','status','stock']))
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-100 rounded-lg text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Limpiar filtros
                </a>
            @endif

        </form>

        <div class="p-4 flex justify-between items-center">

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Productos
            </h2>

            <button id="toggleView"
                    class="px-3 py-1 text-sm rounded-lg bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                Cambiar vista
            </button>

        </div>

        <!-- TABLE -->
        <div id="tableView" class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 dark:bg-gray-700">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                            Producto
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                            Precio
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                            Stock
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                            Estado
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-medium text-gray-600 dark:text-gray-200">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($products as $product)

                        <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">

                            <!-- PRODUCTO -->
                            <td class="px-6 py-4 flex items-center gap-3">

                                <img src="{{ $product->image_url }}"
                                     class="w-12 h-12 rounded-lg object-cover border dark:border-gray-700">

                                <div>
                                    <p class="text-gray-800 dark:text-gray-100 font-medium">
                                        {{ $product->name }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $product->slug }}
                                    </p>
                                </div>

                            </td>

                            <!-- PRECIO -->
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                €{{ number_format($product->price, 2) }}
                            </td>

                            <!-- STOCK -->
                            <td class="px-6 py-4">

                                <input type="number"
                                    value="{{ $product->stock }}"
                                    min="0"
                                    class="w-20 rounded-lg text-gray-800 dark:text-gray-100 dark:bg-gray-900 dark:border-gray-700 border-gray-300 text-center"                                    
                                    onchange="updateStock(this, {{ $product->id }})">

                            </td>

                            <!-- ESTADO -->
                            <td class="px-6 py-4">

                                <span class="px-3 py-1 text-xs rounded-full {{ $product->status_badge['class'] }}">
                                    {{ $product->status_badge['text'] }}
                                </span>

                            </td>

                            <!-- ACCIONES -->
                            <td class="px-6 py-4">

                                <x-admin.action-group
                                    :show="route('admin.products.show', $product)"
                                    :edit="route('admin.products.edit', $product)"
                                    :delete="route('admin.products.destroy', $product)"
                                />

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div id="cardView" class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 hidden">
            @foreach($products as $product)

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-4">

                    <img src="{{ $product->image_url }}"
                        class="w-full h-40 object-cover rounded-lg mb-3">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ $product->name }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        €{{ number_format($product->price, 2) }}
                    </p>

                    <div class="mt-3 flex justify-between items-center">

                        <span class="text-xs px-2 py-1 rounded-full {{ $product->status_badge['class'] }}">
                            {{ $product->status_badge['text'] }}
                        </span>

                        <x-admin.action-group
                            :show="route('admin.products.show', $product)"
                            :edit="route('admin.products.edit', $product)"
                            :delete="route('admin.products.destroy', $product)"
                        />

                    </div>

                </div>

            @endforeach

        </div>

        
        <!-- PAGINATION -->
        <div class="p-4 border-t dark:border-gray-700">
            {{ $products->links() }}
        </div>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const table = document.getElementById('tableView');
        const cards = document.getElementById('cardView');

        document.getElementById('toggleView').addEventListener('click', () => {
            table.classList.toggle('hidden');
            cards.classList.toggle('hidden');
        });
    });


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