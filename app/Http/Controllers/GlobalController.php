<?php

namespace App\Http\Controllers;

use Purifier;
use App\Tag;
use App\Menu;
use App\Inbox;
use Illuminate\Http\Request;

class GlobalController extends Controller
{

    public function menu($slug){
        $menu    = Menu::whereSlug($slug)->first();
        if ($menu) {
            if ($menu->setting==0) {
                $posts = $menu->posts()->orderBy('sticky','DESC')->latest()->paginate(10);
                if ($posts->count() == 1) {
                    return redirect("/read/post/{$posts[0]->slug}");
                }else{
                    return view('posts.index', compact('menu','posts'));
                }
            }elseif ($menu->setting==1) {
                $products = $menu->products()->orderBy('sticky','DESC')->latest()->paginate(9);
                return view('products.index', compact('menu','products'));
            }elseif ($menu->setting==2) {
                $threads = $menu->forums()->latest()->paginate(10);
                return view('threads.index', compact('menu','threads'));
            }
        }else{
            return redirect('/');
        }
    }

    public function tag($slug){
        $tag = Tag::whereSlug($slug)->first();
        if ($tag) {
            $posts    = $tag->posts()->orderBy('sticky','DESC')->latest()->paginate(10);
            // $products = $tag->products()->paginate(8);
            // $threads  = $tag->forums()->paginate(10);
            // return view('tags.index', compact('tag','posts','products','threads'));
            return view('tags.index', compact('tag','posts'));
        }
        return redirect('/');
    }

    public function contact(Request $request){
        $this->validate($request, [
            'title' => 'required|max:150',
            'email' => 'required',
            'phone' => 'required',
            'description' => 'required|max:10000',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
        Inbox::create([
            'title' => Purifier::clean($request->title),
            'email' => Purifier::clean($request->email),
            'phone' => Purifier::clean($request->phone),
            'description' => Purifier::clean($request->description),
        ]);
        return back()->with('status', 'Pesan terkirim.');
    }
    
}
