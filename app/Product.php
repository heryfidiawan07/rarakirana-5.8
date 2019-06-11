<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','etalase_id','title','slug','first_price','discount','price','weight','description','type','comment','status','sticky',];

    public function etalase(){
        return $this->belongsTo('App\Etalase');
    }
    
    public function tags(){
        return $this->morphToMany('App\Tag','tagable');
    }

    public function pictures(){
        return $this->hasMany('App\Picture');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
    
    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function messages(){
        return $this->morphMany('App\Message','messageable');
    }

    public function delivery(){
        return $this->hasMany('App\OrderDetail');
    }
    
}
