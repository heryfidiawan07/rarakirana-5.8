<?php

namespace App\Http\Controllers;

use App\Post;
use App\Product;
use App\Forum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status',1)->orderBy('sticky','DESC')->paginate(5);
        $posts    = Post::where('status',1)->orderBy('sticky','DESC')->paginate(6);
        $threads  = Forum::where('status',1)->paginate(6);
        return view('home', compact('products','posts','threads'));
    }

}
