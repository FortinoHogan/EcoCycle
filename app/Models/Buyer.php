<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = 'buyers';
    protected $guarded = [];
    protected $fillable = [
        'email',
        'password',
        'name',
        'phone',
        'greenPoint',
        'role',
        'profileImage',
    ];

    public function cart ()
    {
        return $this->hasMany(Cart::class, 'buyer_id');
    }

    public function transactionHeader ()
    {
        return $this->hasMany(TransactionHeader::class, 'buyer_id');
    }

    public function address ()
    {
        return $this->hasMany(Address::class, 'buyer_id');
    }

    public function post ()
    {
        return $this->hasMany(Post::class, 'buyer_id');
    }
}
