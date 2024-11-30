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

    public function checkout() {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }
}
