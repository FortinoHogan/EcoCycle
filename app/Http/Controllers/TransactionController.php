<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class TransactionController extends Controller
{
    public function detail_product($product_id)
    {
        $product = Product::with(['description'])->where('id', $product_id)->first();

        return view('shop-detail', compact('product'));
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

    public function checkout(Request $request)
    {
        $buyerId = session('buyer')->id;
        $productIds = $request->input('product_ids');

        if (empty($productIds)) {
            return response()->json(['message' => 'No products selected for checkout'], 400);
        }

        // $cart = Cart::where('buyer_id', $buyerId)->whereIn('product_id', $productIds)->get();

        $cart = Cart::with(['product'])
            ->whereIn('product_id', $productIds)
            ->where('buyer_id', $buyerId)
            ->get();

        dd($cart);
        foreach ($cart as $item) {
            $imagePath = $item->product->image;

            if ($imagePath && file_exists($imagePath)) {
                $item->product->image = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($imagePath));
            } else {
                // Handle the error, e.g., set a default image or log the error
                $item->product->image = 'default-image-path';
            }

            // $item->product->image = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($item->product->image));
        }

        return response()->json(['message' => $cart]);

        // $cart = $cart->map(function ($item) {
        //     $product = $item->product;
        //     return [
        //         'product_name' => $product ? $product->name : 'N/A',
        //         'price' => $product ? $product->price : 0,
        //         'quantity' => $item->quantity,
        //         'product_image' => $product && $product->image ? "data:image/jpeg;base64," . base64_encode($product->image) : null
        //     ];
        // });

        // return view('checkout', compact('cart'));
    }
}
