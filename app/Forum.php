<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['user_id','category_id','title','slug','description','comment','status',];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function menu(){
        return $this->belongsTo('App\Menu');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function tags(){
        return $this->morphToMany('App\Tag','tagable');
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }
    
}
