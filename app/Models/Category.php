<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    protected $fillable = [
        'product_id',
        'category'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
