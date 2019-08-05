<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','commentable_id','commentable_type','description','status','parent_id',];

    public function commentable(){
        return $this->morphTo();
    }

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function childs(){
        return $this->hasMany(Comment::class, 'parent_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
