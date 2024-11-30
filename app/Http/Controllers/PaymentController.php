<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function success() {
        return view('success');
    }

    public function process(Request $request)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Example transaction details
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 100000, // Payment amount
            ],
            'customer_details' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@example.com',
                'phone' => '081234567890',
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('shop-detail', ['token' => $snapToken ?? null]);
        } catch (\Exception $e) {
            return view('shop-detail', ['token' => null]); // Ensure token is always passed
        }
    }
}
