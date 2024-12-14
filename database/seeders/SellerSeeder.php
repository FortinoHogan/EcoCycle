<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Seller::create([
            'user_id' => '2',
            'email' => 'tino@gmail.com',
            'password' => Hash::make('asdasdasd'),
            'name' => 'Tino',
            'phone' => '08123456789',
            'region' => 'Jakarta Barat',
            'role' => 'Seller',
            'balance' => '0',
        ]);
    }
}
