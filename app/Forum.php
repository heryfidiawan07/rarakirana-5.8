<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['user_id','category_id','title','slug','description','comment','status',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function tags(){
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    
}
