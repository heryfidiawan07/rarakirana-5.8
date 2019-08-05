<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $fillable = ['user_id','description','gender','birthday'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
