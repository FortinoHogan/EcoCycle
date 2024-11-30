<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index() {
        $product = Product::all();
        return view('shop', compact('product'));
    }
}
