<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'menu_id', 'parent_id', 'name', 'slug', 'title', 'description', 'status', 'icon'
    ];

    public function parent(){
        return $this->belongsTo('App\Category','parent_id');
    }
    
    public function childs(){
        return $this->hasMany('App\Category','parent_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function menu(){
        return $this->belongsTo('App\Menu');
    }

    public function forums(){
        return $this->hasMany('App\Forum');
    }
    
}
