<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(){
        $menus      = Menu::where('setting',2)->get();
        $categories = Category::all();
        return view('admin.categories.index', compact('categories','menus'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
            'menu_id' => 'required',
            'parent_id' => 'required',
        ]);
        Category::create([
            'name' => $request->name,
            'slug' => str_slug($request->name),
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'menu_id' => $request->menu_id,
            'parent_id' => $request->parent_id,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        // $cekSlug = Category::where('slug', str_slug($request->nameEdit))->first();
        // dd($cekSlug->count());
        // if ($cekSlug) {
        //     return back()->withErrors('Category name already exists !');
        // }
        $request->validate([
            'nameEdit' => 'required',
            'menu_edit' => 'required',
            'parent_edit' => 'required',
        ]);
        $category->update([
            'name' => $request->nameEdit,
            'slug' => str_slug($request->nameEdit),
            'title' => $request->titleEdit,
            'description' => $request->descriptionEdit,
            'icon' => $request->iconEdit,
            'menu_id' => $request->menu_edit,
            'parent_id' => $request->parent_edit,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        return back();
    }
    
    public function getChildMenu($id){//JQuery Mengambil parent child berdasarkan Parent Menu yang di pilih
        $menu = Menu::find($id);
        return response(['childs' => $menu->categories, 'count' => $menu->categories->count()]);
    }

}
