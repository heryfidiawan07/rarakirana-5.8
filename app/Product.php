<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id','etalase_id','title','slug','first_price','discount','price','weight','description','type','comment','status','sticky',];

    public function etalase(){
        return $this->belongsTo(Etalase::class);
    }
    
    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function pictures(){
        return $this->hasMany(Picture::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function messages(){
        return $this->morphMany(Message::class, 'messageable');
    }

    public function delivery(){
        return $this->hasMany(OrderDetail::class);
    }
    
}
