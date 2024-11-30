<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Description;

class ShopController extends Controller
{
    public function index() {
        $product = Product::with(['description'])->get();

        return view('shop', compact('product'));
    }
}
