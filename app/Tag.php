<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'user_id', 'slug', 'title', 'description', 'icon', 'status_menu',];

    public function posts(){
        return $this->morphedByMany(Post::class, 'tagable');
    }

    public function products(){
        return $this->morphedByMany(Product::class, 'tagable');
    }

    public function forums(){
        return $this->morphedByMany(Forum::class, 'tagable');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
