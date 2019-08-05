<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'parent_id', 'name', 'slug', 'title', 'description', 'status', 'setting', 'icon', 'contact'
    ];

    public function roles(){
        return $roles = ['Post Menu (default)','Product Menu','Forum Menu'];   
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function childs(){
        return $this->hasMany(Menu::class, 'parent_id');
    }
    
    public function parent(){
        return $this->belongsTo(Menu::class,'parent_id');
    }
    
    public function etalases(){
        return $this->hasMany(Etalase::class);
    }
    
    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function products(){
        return $this->hasManyThrough(Product::class, Etalase::class);
    }

    public function forums(){
        return $this->hasManyThrough(Forum::class, Category::class);
    }
    
}
