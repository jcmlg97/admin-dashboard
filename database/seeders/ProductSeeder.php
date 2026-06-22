<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            [
                'name' => 'Auriculares Newskill Aton V2 Black',
                'description' => 'Los nuevos Newskill Aton V2, Auriculares gaming con triple conectividad mejorada en alcance y rendimiento, te descubrirán una nueva forma de disfrutar del mejor sonido premium, gracias a la calidad de sus materiales, y compatibles con múltiples dispositivos. Déjate atrapar por sus increíbles y cómodos materiales, como sus almohadillas de tela transpirable, Aton V2 serán siempre uno de tus mejores aliados.',
                'price' => 79.90,
                'stock' => 18,
                'status' => 'active',
            ],

            [
                'name' => 'Portátil Gaming',
                'description' => 'Portátil de alto rendimiento',
                'price' => 1299.99,
                'stock' => 5,
                'status' => 'active',
            ],

            [
                'name' => 'Teclado Mecánico',
                'description' => 'Teclado RGB mecánico',
                'price' => 89.99,
                'stock' => 12,
                'status' => 'active',
            ],

            [
                'name' => 'Ratón Inalámbrico',
                'description' => 'Ratón ergonómico inalámbrico',
                'price' => 39.99,
                'stock' => 0,
                'status' => 'inactive',
            ],

        ];

        foreach ($products as $product) {

            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'status' => $product['status'],
            ]);
        }
    }
}