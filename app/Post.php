<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','menu_id','title','slug','description','img','comment','status','sticky',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    
    public function tags(){
        return $this->morphToMany(Tag::class, 'tagable');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    
}
