<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buyer::create([
            'email' => 'hendri@gmail.com',
            'password' => Hash::make('hendri123'),
            'name' => 'Hendri',
            'phone' => '0812312312',
            'greenPoint' => '0',
            'role' => 'buyer',
            'profileImage' => file_get_contents(public_path('asset/buyer/buyer.jpg'))
        ]);
    }
}
