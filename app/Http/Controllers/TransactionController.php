<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Description;
use App\Models\ProductCategory;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function detail_product($product_id)
    {
        $product = Product::with(['description'])->where('id', $product_id)->first();
        $description = Description::where('product_id', $product_id)->first();
        $categoriesSelected = ProductCategory::where('product_id', $product_id)->get();
        $categories = Category::all();

        return view('shop-detail', compact('product', 'description', 'categoriesSelected', 'categories'));
    }

    public function add_to_cart(Request $request)
    {
        $productId = $request->input('product_id');
        $buyerId = session('buyer')->id;

        $cart = Cart::where('buyer_id', $buyerId)->where('product_id', $productId)->first();

        if ($cart) {
            Cart::where('buyer_id', $buyerId)
                ->where('product_id', $productId)
                ->update(['quantity' => $cart->quantity + 1]);
        } else {
            Cart::create([
                'buyer_id' => $buyerId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return response()->json(['message' => 'Product added to cart']);
    }

    public function cart()
    {
        $cart = Cart::with(['product'])->where('buyer_id', session('buyer')->id)->get();
        return view('cart', compact('cart'));
    }

    public function update_quantity(Request $request)
    {
        $productId = $request->input('product_id');
        $buyerId = session('buyer')->id;

        $action = $request->input('action');

        $cart = Cart::where('buyer_id', $buyerId)->where('product_id', $productId)->first();

        if ($cart) {
            if ($action === 'increment') {
                Cart::where('buyer_id', $buyerId)
                    ->where('product_id', $productId)
                    ->update(['quantity' => $cart->quantity + 1]);
            } elseif ($action === 'decrement') {
                $cart->quantity -= 1;
                // If quantity becomes zero, remove the item from the cart
                if ($cart->quantity <= 0) {
                    Cart::where('buyer_id', $buyerId)
                        ->where('product_id', $productId)
                        ->delete();
                }
            }

            session()->put('cart', $cart);

            return response()->json([
                'message' => 'Cart updated',
            ]);
        }
        return response()->json(['message' => 'Product not found in cart'], 404);
    }

    public function remove_from_cart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]); // Remove the item from the cart
            session()->put('cart', $cart);

            return response()->json(['message' => 'Item removed']);
        }

        return response()->json(['message' => 'Item not found in cart'], 404);
    }

    public function process_checkout(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $buyer = session('buyer');
        $productIds = $request->input('product_ids');

        if (empty($productIds)) {
            return response()->json(['message' => 'No products selected for checkout'], 400);
        }

        $cart = Cart::with(['product'])
            ->whereIn('product_id', $productIds)
            ->where('buyer_id', $buyer->id)
            ->get();

        $address = Address::where('buyer_id', $buyer->id)->where('main', true)->first();

        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->product->price * $item->quantity;
        }

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $total_price + 10000, // Payment amount
            ],
            'customer_details' => [
                'first_name' => $buyer->name,
                // 'last_name' => 'Doe',
                'email' => $buyer->email,
                'phone' => $buyer->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        TransactionHeader::create([
            'id' => $params['transaction_details']['order_id'],
            'status' => 'unpaid',
            'buyer_id' => $buyer->id,
            'total_price' => $total_price,
            'shipping_fee' => 10000,
            'grand_total' => $total_price + 10000,
            'snap_token' => $snapToken,
            'total_price' => $total_price,
            'address_id' => $address->id ?? null
        ]);

        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => TransactionHeader::latest()->first()->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity
            ]);
        }

        return redirect()->route('checkout', ['transaction_id' => TransactionHeader::latest()->first()->id]);
    }

    public function checkout($transaction_id)
    {
        $cart = TransactionDetail::with(['product'])->where('transaction_id', $transaction_id)->get();
        $transaction = TransactionHeader::where('id', $transaction_id)->first();

        return view('checkout', ['cart' => $cart, 'transaction' => $transaction]);
    }

    public function process_success(Request $request) {
        $transaction_id = $request->input('transaction_id');
        $midtrans_data = $request->input('midtrans_data');

        TransactionHeader::where('id', $transaction_id)->update(['status' => 'paid']);

        return view('success', compact('transaction_id', 'midtrans_data'));
    }
    public function success($transaction_id, $midtrans_data) {
        dd($transaction_id, $midtrans_data);        
        return view('success');
    }
}
