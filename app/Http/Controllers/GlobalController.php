<?php

namespace App\Http\Controllers;

use Purifier;
use App\Tag;
use App\Menu;
use App\Inbox;
use App\Post;
use App\Forum;
use App\Product;
use Illuminate\Http\Request;

class GlobalController extends Controller
{

    public function menu($slug){
        $menu    = Menu::whereSlug($slug)->first();
        if ($menu) {
            if ($menu->setting==0) {
                $posts = $menu->posts()->whereStatus(1)
            			->whereHas('menu', function ($query) {
	                        $query->where('status', 1);
	                    })->orderBy('sticky','DESC')->paginate(10);
                if ($posts->count() == 1) {
                    return redirect("/read/post/{$posts[0]->slug}");
                }else{
                    return view('posts.index', compact('menu','posts'));
                }
            }elseif ($menu->setting==1) {
                $products = $menu->products()->whereStatus(1)
			                ->whereHas('etalase', function ($query) {
		                        $query->where('status', 1);
		                    })->orderBy('sticky','DESC')->paginate(9);
                return view('products.index', compact('menu','products'));
            }elseif ($menu->setting==2) {
                $threads = $menu->forums()
                			->whereHas('category', function ($query) {
		                        $query->where('status', 1);
		                    })->latest()->paginate(10);
                return view('threads.index', compact('menu','threads'));
            }
        }else{
            return redirect('/');
        }
    }

    public function tag($slug){
        $tag = Tag::whereSlug($slug)->first();
        if ($tag) {
            $posts    = $tag->posts()->whereStatus(1)
            			->whereHas('menu', function ($query) {
	                        $query->where('status', 1);
	                    })->paginate(10);
            $products = $tag->products()->whereStatus(1)
            			->whereHas('etalase', function ($query) {
	                        $query->where('status', 1);
	                    })->paginate(8);
            $threads  = $tag->forums()->whereStatus(1)
            			->whereHas('category', function ($query) {
	                        $query->where('status', 1);
	                    })->paginate(10);
            return view('tags.index', compact('tag','posts','products','threads'));
            // return view('tags.index', compact('tag','posts'));
        }
        return redirect('/');
    }

    public function contact(Request $request){
        $this->validate($request, [
            'title' => 'required|max:150',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required|max:10000',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        Inbox::create([
            'title' => Purifier::clean($request->title),
            'email' => Purifier::clean($request->email),
            'phone' => Purifier::clean($request->phone),
            'description' => Purifier::clean($request->description),
        ]);
        return back()->with('status', 'Pesan terkirim.');
    }
    
    public function search(Request $request){
        $posts    = Post::where('title','like','%'.$request->search.'%')->where('status',1)
        			->whereHas('menu', function ($query) {
                        $query->where('status', 1);
                    })->paginate(6);
        $products = Product::where('title','like','%'.$request->search.'%')->where('status',1)
        			->whereHas('etalase', function ($query) {
                        $query->where('status', 1);
                    })->paginate(5);
        $threads  = Forum::where('title','like','%'.$request->search.'%')->where('status',1)
        			->whereHas('category', function ($query) {
                        $query->where('status', 1);
                    })->paginate(6);
        $key      = $request->search;
        return view('search.global', compact('products','posts','threads','key'));
    }

    public function searchPosts($key){
        $posts = Post::where('title','like','%'.$key.'%')->where('status',1)
        		->whereHas('menu', function ($query) {
                        $query->where('status', 1);
                    })->paginate(20);
        return view('search.posts', compact('posts'));
    }

    public function searchProducts($key){
        $products = Product::where('title','like','%'.$key.'%')->where('status',1)
        			->whereHas('etalase', function ($query) {
                        $query->where('status', 1);
                    })->paginate(20);
        return view('search.products', compact('products'));
    }
    
    public function searchThreads($key){
        $threads = Forum::where('title','like','%'.$key.'%')->where('status',1)
        			->whereHas('category', function ($query) {
                        $query->where('status', 1);
                    })->paginate(20);
        return view('search.threads', compact('threads'));
    }

}
