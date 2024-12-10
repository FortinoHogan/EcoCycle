<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'buyer_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
