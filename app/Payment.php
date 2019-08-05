<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['no_invoice', 'order_id','pengirim','image_resi','keterangan','status',];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
    
}
