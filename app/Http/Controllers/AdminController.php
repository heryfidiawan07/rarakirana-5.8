<?php

namespace App\Http\Controllers;

use App\User;
use App\Share;
use App\Follow;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    
    public function socialMedia(){
        $adminFollow      = new Follow;
        $adminFollowClass = $adminFollow->roles();

        $adminShare      = new Share;
        $adminShareClass = $adminShare->shares();
        $adminShareUrls  = $adminShare->urls();

        $follows = Follow::all();
        $shares  = Share::all();
        return view('admin.social-media.index', compact('follows','shares','adminFollowClass','adminShareClass','adminShareUrls'));
    }
    
    public function users(){
        $users = User::paginate(50);
        return view('admin.users.index', compact('users'));
    }
    
}
