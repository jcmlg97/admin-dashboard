<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ActivityLog;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // SEARCH
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // STATUS FILTER
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // STOCK FILTER
        if ($request->filled('stock')) {
            if ($request->stock === 'low') {
                $query->where('stock', '<', 5);
            } elseif ($request->stock === 'out') {
                $query->where('stock', 0);
            }
        }

        $products = $query->latest()->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',

            // 👇 opcional porque lo generas automáticamente
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',

            'status' => 'required|in:active,inactive,draft',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG
        $data['slug'] = Str::slug($data['name']);

        // evitar slugs duplicados
        if (Product::where('slug', $data['slug'])->exists()) {
            $data['slug'] .= '-' . time();
        }

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product = Product::create($data);

        log_activity(
            'created_product',
            "Producto creado: {$product->name}"
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto creado correctamente');
    }

        public function show(Product $product)
        {
            $lastActivity = ActivityLog::whereIn('action', [
                'created_product',
                'updated_product',
                'deleted_product',
                'updated_stock'
            ])
            ->latest()
            ->first();

            return view('admin.products.show', compact('product', 'lastActivity'));
        }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,draft',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG (por si cambia nombre)
        $data['slug'] = Str::slug($data['name']);

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($data);

        log_activity('updated_product', "Producto actualizado: {$product->name}");

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        log_activity('deleted_product', "Producto eliminado: {$product->name}");

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Producto eliminado correctamente');
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $oldStock = $product->stock;

        $product->update([
            'stock' => $request->stock
        ]);

        log_activity(
            'updated_stock',
            "Stock actualizado en {$product->name}: {$oldStock} → {$product->stock}"
        );

        return response()->json([
            'success' => true,
            'stock' => $product->stock
        ]);
    }
}