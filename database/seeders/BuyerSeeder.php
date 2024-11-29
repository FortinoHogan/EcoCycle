<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buyer;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buyer::create([
            'email' => 'buyer@gmail.com',
            'password' => 'buyer',
            'name' => 'buyer',
            'phone' => '0123456789',
            'greenPoint' => '0',
            'role' => 'buyer',
            'profileImage' => file_get_contents(public_path('asset/buyer/buyer.jpg'))
        ]);
    }
}
