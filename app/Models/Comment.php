<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function buyer(){
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }
}
