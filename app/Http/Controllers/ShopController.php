<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Description;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $searchQuery = request('search');
        $sortOption = request('sort');

        $query = Product::where('seller_id', session('seller')->id);

        if ($searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%");
        }

        switch ($sortOption) {
            case 'alphabetical-ascending':
                $query->orderBy('name', 'asc');
                break;
            case 'alphabetical-descending':
                $query->orderBy('name', 'desc');
                break;
            case 'most-price':
                $query->orderBy('price', 'desc');
                break;
            case 'least-price':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(6)->appends([
            'search' => $searchQuery, 
            'sort' => $sortOption
        ]);

        $categories = Category::all();
        return view('seller.shop', compact('products', 'categories', 'searchQuery', 'sortOption'));
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
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ingredients' => 'required',
            'origin' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
        ], [
            'name.required' => 'Product name is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a number',
            'stock.required' => 'Product stock is required',
            'stock.numeric' => 'Product stock must be a number',

            'image.required' => 'Product image is required',
            'image.image' => 'Product image must be an image file',
            'image.mimes' => 'Product image must be a JPEG, PNG, or JPG file',
            'image.max' => 'Product image size must be less than 2MB',

            'ingredients.required' => 'Product ingredients is required',
            'origin.required' => 'Product origin is required',
            'description.required' => 'Product description is required',
            'categories.required' => 'Product categories is required',
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

        return redirect()->route('shop.index')->with('insertSuccess', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'ingredients' => 'required',
            'origin' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
        ], [
            'name.required' => 'Product name is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Product price must be a number',
            'stock.required' => 'Product stock is required',
            'stock.numeric' => 'Product stock must be a number',

            'ingredients.required' => 'Product ingredients is required',
            'origin.required' => 'Product origin is required',
            'description.required' => 'Product description is required',
            'categories.required' => 'Product categories is required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'image.image' => 'Product image must be an image file',
                'image.mimes' => 'Product image must be a JPEG, PNG, or JPG file',
                'image.max' => 'Product image size must be less than 2MB',
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
        return redirect()->route('detail_seller', $id)->with('updateSuccess', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transactionHeaderIds = TransactionDetail::where('product_id', $id)->pluck('transaction_id');
        TransactionDetail::where('product_id', $id)->delete();
        TransactionHeader::whereIn('id', $transactionHeaderIds)->delete();
        Cart::where('product_id', $id)->delete();
        Description::where('product_id', $id)->delete();
        ProductCategory::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect()->route('shop.index')->with('deleteSuccess', 'Product deleted successfully');
    }
}
