<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id','img','name','title','description','telp','hp','email','address','author','company'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
