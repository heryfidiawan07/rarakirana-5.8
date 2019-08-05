<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etalase extends Model
{
    protected $fillable = [
        'user_id', 'menu_id', 'parent_id', 'name', 'slug', 'title', 'description', 'status', 'icon'
    ];

    public function parent(){
        return $this->belongsTo(Etalase::class, 'parent_id');
    }
    
    public function childs(){
        return $this->hasMany(Etalase::class, 'parent_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    
    public function products(){
        // return $this->hasMany('App\Product');
        if ( $this->childs()->count()){
            return $this->hasManyThrough(Product::class, Etalase::class, 'parent_id');
        }else{
            return $this->hasMany(Product::class);
        }
    }
    
}
