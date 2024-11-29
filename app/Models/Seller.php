<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';
    protected $guarded = [];
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'region',
        'role',
        'balance',
        'profileImage',
    ];

    public function product ()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}
