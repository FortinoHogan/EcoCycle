<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
        $product = \App\Models\Product::find($productId);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $cart = session()->get('cart', []);

        // If product exists, increase quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            // Add product to cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        // Save cart to session
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function update_quantity(Request $request)
    {
        $productId = $request->input('product_id');
        $action = $request->input('action');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($action === 'increment') {
                $cart[$productId]['quantity']++;
            } elseif ($action === 'decrement') {
                $cart[$productId]['quantity']--;

                // If quantity becomes zero, remove the item from the cart
                if ($cart[$productId]['quantity'] <= 0) {
                    unset($cart[$productId]);
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
}
