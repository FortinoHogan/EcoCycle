<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];
    protected $fillable = [
        'category'
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
