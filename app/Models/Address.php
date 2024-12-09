<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $guarded = [];
    protected $fillable = [
        'buyer_id',
        'recipient_name',
        'phone',
        'street',
        'subdistrict',
        'city',
        'province',
        'postal_code',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function transaction_header() {
        return $this->belongsTo(TransactionHeader::class, 'transaction_id');
    }
}
