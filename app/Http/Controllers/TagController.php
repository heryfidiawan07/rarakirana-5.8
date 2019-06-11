<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }

    public function index(){
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function store(Request $request){
        $cekSlug = Tag::whereSlug(str_slug($request->name))->first();
        if ($cekSlug) {
            $slug = str_slug($request->name).date('His');
        }else {
            $slug = str_slug($request->name);
        }
        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => Purifier::clean($request->description),
            'status_menu' => $request->status_menu,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function update(Request $request, $id){
        $tag = Tag::find($id);
        $cekSlug = Tag::whereSlug(str_slug($request->nameEdit))->first();
        if ($cekSlug) {
            $slug = str_slug($request->nameEdit).date('His');
        }else {
            $slug = str_slug($request->nameEdit);
        }
        $tag->update([
            'name' => $request->nameEdit,
            'slug' => $slug,
            'title' => $request->titleEdit,
            'icon' => $request->iconEdit,
            'description' => Purifier::clean($request->descEdit),
            'status_menu' => $request->status_menu_edit,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function storeAjax(Request $request){
        $tags = Tag::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'user_id' => Auth::user()->id,
        ]);
        return response($tags);
    }

    public function updateAjax(Request $request, $id){
        $tag = Tag::find($id);
        $tag->update([
            'name' => $request->nameEdit,
            'slug' => str_slug($request->nameEdit),
            'user_id' => Auth::user()->id,
        ]);
        return response($tag);
    }
    
    public function deleteAjax($id){
        $tag = Tag::find($id);
        $tag->delete();
        return response($tag);
    }

    public function delete($id){
        $tag = Tag::find($id);
        $tag->delete();
        return back();
    }

}
