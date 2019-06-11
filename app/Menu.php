<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id', 'user_id', 'name', 'slug', 'title', 'description', 'status', 'setting', 'icon','contact'
    ];

    public function roles(){
        return $roles = ['Post Menu (default)','Product Menu','Forum Menu'];   
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function childs(){
        return $this->hasMany('App\Menu', 'parent_id');
    }
    
    public function parent(){
        return $this->belongsTo('App\Menu','parent_id');
    }
    
    public function etalases(){
        return $this->hasMany('App\Etalase');
    }
    
    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function products(){
        return $this->hasManyThrough('App\Product','App\Etalase');
    }

    public function forums(){
        return $this->hasManyThrough('App\Forum','App\Category');
    }
    
}
