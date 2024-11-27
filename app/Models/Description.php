<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $table = 'description';
    protected $guarded = [];
    protected $fillable = [
        'product_id',
        'ingredient',
        'origin',
        'description'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
