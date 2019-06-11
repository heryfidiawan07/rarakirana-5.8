<?php

namespace App\Http\Controllers;

use App\User;
use Socialite;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;

class SocialController extends Controller
{

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect('/');
    }
    
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        $cekSlug = User::where('slug', str_slug($getInfo->name))->first();
        if (!$user) {
            if ($cekSlug) {
                $slug = str_slug($getInfo->name).date('His');
            }else {
                $slug = str_slug($getInfo->name);
            }
            $user = User::create([
                'name'     => $getInfo->name,
                'slug'     => $slug,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'token' => str_random(50),
                'img'   => 'profile.jpg',
                'role' => 0,
                'status' => 1,
            ]);
        }
        return $user;
     }

}
