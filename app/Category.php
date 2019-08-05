<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'menu_id', 'parent_id', 'name', 'slug', 'title', 'description', 'status', 'icon'
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    public function childs(){
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function forums(){
        return $this->hasMany(Forum::class);
    }
    
}
