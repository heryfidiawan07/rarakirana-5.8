<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'user_id', 'slug', 'title', 'description', 'icon', 'status_menu',];

    public function posts(){
        return $this->morphedByMany('App\Post','tagable');
    }

    public function products(){
        return $this->morphedByMany('App\Product','tagable');
    }

    public function forums(){
        return $this->morphedByMany('App\Forum','tagable');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
