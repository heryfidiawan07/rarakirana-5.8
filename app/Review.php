<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['user_id', 'review', 'product_id', 'order_id',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
