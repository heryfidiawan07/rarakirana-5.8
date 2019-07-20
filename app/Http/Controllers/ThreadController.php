<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Forum;
use App\Category;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct(){
        return $this->middleware('auth', ['except'=>['show','category']]);
    }
    
    public function create(){
        $categories = Category::all();
        return view('threads.create', compact('categories'));
    }
    
    public function store(Request $request){
        $data = request()->validate([
            'title' => 'required|unique:forums|max:255',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        $thread = Forum::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'category_id' => $request->category_id,
            'description' => Purifier::clean($request->description),
            'user_id' => Auth::user()->id,
        ]);
        return redirect("/thread/{$thread->slug}");
    }

    public function edit($slug){
        $thread = Forum::whereSlug($slug)->first();
        $categories = Category::all();
        return view('threads.edit', compact('thread','categories'));
    }
    
    public function update(Request $request, $slug){
        $data = request()->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'description' => 'required',
        ]);
        $thread  = Forum::whereSlug($slug)->first();
        $cekSlug = str_slug($request->title);
        $forum   = Forum::whereSlug($cekSlug)->first();
        if ($forum==null) {
            $slug = str_slug($request->title);//true
        }else{
            if ($forum->id == $thread->id) {
                $slug = str_slug($request->title);//true
            }else {
                $slug = str_slug($request->title.'-'.date("YmdHis"));//false
            }
        }
        $thread->update([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'description' => Purifier::clean($request->description),
            'user_id' => Auth::user()->id,
        ]);
        return redirect("/thread/{$thread->slug}");
    }
    
    public function show($slug){
        $thread = Forum::whereSlug($slug)->first();
        if ($thread->status==1) {
            $categories = Category::all();
            return view('threads.show', compact('thread','categories'));
        }
        return view('errors.404');
    }

    public function category($slug){
        $category   = Category::whereSlug($slug)->first();
        $categories = Category::all();
        if ($category->status==1) {
            $threads = $category->forums()->paginate(10);
            return view('threads.category', compact('category','categories','threads'));
        }
        return view('errors.404');
    }
    
}
