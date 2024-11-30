<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Seller::create([
            'email' => 'seller@gmail.com',
            'password' => 'seller',
            'name' => 'seller',
            'phone' => '0123456789',
            'region' => 'Jakarta Barat',
            'role' => 'Seller',
            'balance' => '0',
        ]);
    }
}
