<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['name','penerima', 'address', 'prov_id', 'provinsi', 'kab_id', 'kabupaten', 'kec_id', 'kecamatan','postal_code','phone','user_id','origin',];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
