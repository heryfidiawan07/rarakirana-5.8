<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['class','link','user_id',];

    public function roles(){
        return $roles = ['fab fa-facebook-square','fab fa-instagram','fab fa-youtube','fab fa-twitter-square','fab fa-linkedin','fab fa-pinterest-square','fab fa-whatsapp-square','fab fa-google-plus-square','fas fa-phone-square','fas fa-comment-alt','fas fa-envelope',];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
