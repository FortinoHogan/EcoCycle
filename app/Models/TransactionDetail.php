<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_details';
    protected $guarded = [];
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity'
    ];

    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeader::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
