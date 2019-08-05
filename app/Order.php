<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['no_order','address_id','resi_kurir','total_price','note','kurir','services','ongkir','user_id','status','slug_token','private_token',];

    public function orderStatus(){
        return [ 0 => 'Baru Saja Order', 1 => 'Proses Packing', 2 => 'On Delivery', 3 => 'Arrived / Barang Telah Sampai Tujuan'];
    }

    public function userOrderStatus(){
        return [ 0 => 'Menunggu Pembayaran', 1 => 'Proses Packing', 2 => 'On Delivery', 3 => 'Arrived / Barang Telah Diterima'];
        //=========================================================================================
    }

    public function payStatus(){
        return [0 => 'Baru Saja Transfer', 1 => 'Approved', 2 => 'Payment Rejected'];
    }

    public function userPayStatus(){
        return [0 => 'Menunggu Konfirmasi Admin', 1 => 'Approved', 2 => 'Payment Rejected'];
        //=========================================================================================
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
    
    public function details(){
        return $this->hasMany(OrderDetail::class);
    }
    
}
