<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $fillable = ['class','link','user_id',];

    public function shares(){
        return ['fab fa-facebook-square','fab fa-twitter-square','fab fa-google-plus-square','fab fa-pinterest-square','fab fa-linkedin','fas fa-envelope','fab fa-whatsapp-square','fas fa-phone-square','fas fa-comment-alt',];
    }

    public function urls(){
        return [
            'https://www.facebook.com/sharer.php?u=`url`',
            'https://twitter.com/share?url=[`url`]&text=[`title`]',
            'https://plus.google.com/share?url=[`url`]',
            'https://pinterest.com/pin/create/bookmarklet/?media=[`img`]&url=[`url`]&description=[`title`]',
            'https://www.linkedin.com/shareArticle?url=[`url`]&title=[`title`]',
            'mailto:?subject=[`title`]&body=Check out this site:[`url`]',
            'whatsapp://send?text=`title`',
            'telp://`phone`',
            'sms:`phone`?body=`title`',
            // 'https://www.facebook.com/sharer.php?u=[post-url]',
            // 'https://twitter.com/share?url=[post-url]&text=[post-title]&via=[via]&hashtags=[hashtags]',
            // 'https://plus.google.com/share?url=[post-url]',
            // 'https://pinterest.com/pin/create/bookmarklet/?media=[post-img]&url=[post-url]&is_video=[is_video]&description=[post-title]',
            // 'https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]',
            // 'mailto:?subject=' . '$[post-title]' . '&body=Check out this site: '. '$[post-url]' .'" title="Share by Email',
            // 'link whatsapp',
            // 'telp',
            // 'sms link',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
