<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','menu_id','title','slug','description','img','comment','status','sticky',];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function menu(){
        return $this->belongsTo('App\Menu');
    }
    
    public function tags(){
        return $this->morphToMany('App\Tag','tagable');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
    
}
