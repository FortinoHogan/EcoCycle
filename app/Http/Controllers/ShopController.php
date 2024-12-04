<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Description;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seller = Seller::where('id', session('seller')->id)->first();
        $products = Product::where('seller_id', session('seller')->id)->paginate(6);
        $categories = Category::all();

        return view('seller.shop', compact('seller', 'products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ingredients' => 'required',
            'origin' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $image = file_get_contents($request->file('image')->getRealPath());
        } else {
            return back()->withErrors(['image' => 'An image file is required']);
        }
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
            'popularity' => 0,
            'seller_id' => session('seller')->id,
        ]);

        Description::create([
            'product_id' => $product->id,
            'ingredient' => $request->ingredients,
            'origin' => $request->origin,
            'description' => $request->description,
        ]);

        foreach ($request->categories as $category) {
            ProductCategory::create([
                'category_id' => $category,
                'product_id' => $product->id
            ]);
        }
        return redirect()->route('shop.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'ingredients' => 'required',
            'origin' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $image = file_get_contents($request->file('image')->getRealPath());
        } else {
            $image = Product::where('id', $id)->first()->image;
        }
        Product::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $image,
        ]);

        Description::where('product_id', $id)->update([
            'ingredient' => $request->ingredients,
            'origin' => $request->origin,
            'description' => $request->description,
        ]);

        ProductCategory::where('product_id', $id)->delete();

        foreach ($request->categories as $category) {
            ProductCategory::where('product_id', $id)->create([
                'category_id' => $category,
                'product_id' => $id
            ]);
        }
        return redirect()->route('shop.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
