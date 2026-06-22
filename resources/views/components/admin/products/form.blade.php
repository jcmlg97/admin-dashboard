@props(['product' => null])

<div class="space-y-6">

    <!-- NAME -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Nombre
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white">

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- SLUG (readonly) -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Slug
        </label>

        <input
            type="text"
            value="{{ $product->slug ?? 'Se generará automáticamente' }}"
            readonly
            class="w-full rounded-lg bg-gray-100 dark:bg-gray-800
                   border-gray-300 dark:border-gray-700
                   text-gray-500 dark:text-gray-400">
    </div>

    <!-- DESCRIPTION -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Descripción
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>

        @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- PRICE + STOCK -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- PRICE -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Precio (€)
            </label>

            <input
                type="number"
                step="0.01"
                min="0"
                name="price"
                value="{{ old('price', $product->price ?? '') }}"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700
                       dark:bg-gray-900 dark:text-white">

            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- STOCK -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                Stock
            </label>

            <input
                type="number"
                min="0"
                name="stock"
                value="{{ old('stock', $product->stock ?? 0) }}"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700
                       dark:bg-gray-900 dark:text-white">

            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- IMAGE UPLOAD (RECOMENDADO) -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Imagen del producto
        </label>

        <input
            type="file"
            name="image"
            accept="image/*"
            class="w-full rounded-lg border border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white p-2">

        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            JPG, PNG o WEBP (máx 2MB)
        </p>

        @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <!-- PREVIEW -->
        @php
            $image = $product->image_url ?? null;
        @endphp

        @if($image)
            <img
                src="{{ $image }}"
                class="mt-3 w-32 h-32 object-cover rounded-lg border dark:border-gray-700">
        @endif
    </div>

    <!-- STATUS -->
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
            Estado
        </label>

        <select
            name="status"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700
                   dark:bg-gray-900 dark:text-white">

            <option value="active" @selected(old('status', $product->status ?? '') === 'active')>
                Activo
            </option>

            <option value="inactive" @selected(old('status', $product->status ?? '') === 'inactive')>
                Inactivo
            </option>

            <option value="draft" @selected(old('status', $product->status ?? '') === 'draft')>
                Borrador
            </option>

        </select>

        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>