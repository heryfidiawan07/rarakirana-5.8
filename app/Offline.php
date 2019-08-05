<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offline extends Model
{
    protected $fillable = ['product_id','phone','email','address','description',];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
