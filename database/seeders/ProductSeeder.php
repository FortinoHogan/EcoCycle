<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            [
                'name' => 'Piggy Bank',
                'price' => 30000,
                'stock' => 10,
                'image' => 'piggybank.jpg',
            ],
            [
                'name' => 'Flower Vase',
                'price' => 25000,
                'stock' => 50,
                'image' => 'vase.jpg',
            ],
            [
                'name' => 'Chair',
                'price' => 100000,
                'stock' => 110,
                'image' => 'chair.jpg',
            ],
            [
                'name' => 'Piggy Bank',
                'price' => 30000,
                'stock' => 10,
                'image' => 'piggybank.jpg',
            ],
            [
                'name' => 'Flower Vase',
                'price' => 25000,
                'stock' => 50,
                'image' => 'vase.jpg',
            ],
            [
                'name' => 'Chair',
                'price' => 100000,
                'stock' => 110,
                'image' => 'chair.jpg',
            ],
            [
                'name' => 'Piggy Bank',
                'price' => 30000,
                'stock' => 10,
                'image' => 'piggybank.jpg',
            ],
            [
                'name' => 'Flower Vase',
                'price' => 25000,
                'stock' => 50,
                'image' => 'vase.jpg',
            ],
        ];

        foreach($products as $p){
            Product::create(array_merge($p, [
                'image' => file_get_contents(public_path('asset/product/'.$p['image'])),
                'seller_id' => 1,
                'popularity' => 0
            ]));
        }
    }
}
