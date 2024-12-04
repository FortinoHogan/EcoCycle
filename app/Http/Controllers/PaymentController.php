<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Product;
use App\Models\TransactionHeader;

class PaymentController extends Controller
{
    public function success() {
        return view('success');
    }

    public function process(Request $request, $product_id)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $product = Product::with(['description'])->where('id', $product_id)->first();
        $auth = session('buyer');

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $product->price, // Payment amount
            ],
            'customer_details' => [
                'first_name' => $auth->name,
                // 'last_name' => 'Doe',
                'email' => $auth->email,
                'phone' => $auth->phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return view('shop-detail', [
                'token' => $snapToken, 
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return view('shop-detail', [
                'token' => null, 
                'product' => $product
            ]);        
        }
    }
}
