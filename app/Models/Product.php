<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
        'seller_id',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'product_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'product_id');
    }

    public function transactionDetail()
    {
        return $this->hasOne(TransactionDetail::class, 'product_id');
    }

    public function cart()
    {
        return $this->hasManyThrough(Cart::class, 'product_id');
    }
}
