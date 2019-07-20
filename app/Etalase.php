<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etalase extends Model
{
    protected $fillable = [
        'user_id', 'menu_id', 'parent_id', 'name', 'slug', 'title', 'description', 'status', 'icon'
    ];

    public function parent(){
        return $this->belongsTo('App\Etalase','parent_id');
    }
    
    public function childs(){
        return $this->hasMany('App\Etalase','parent_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function menu(){
        return $this->belongsTo('App\Menu');
    }
    
    public function products(){
        // return $this->hasMany('App\Product');
        if ( $this->childs()->count()){
            return $this->hasManyThrough('App\Product', 'App\Etalase', 'parent_id');
        }else{
            return $this->hasMany('App\Product');
        }
    }
    
}
