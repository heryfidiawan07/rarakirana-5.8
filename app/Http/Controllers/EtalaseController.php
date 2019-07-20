<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Etalase;
use Illuminate\Http\Request;

class EtalaseController extends Controller
{
    public function __construct()
    {
        return $this->middleware('admin');
    }

    public function index(){
        $menus    = Menu::where('setting',1)->get();
        $etalases = Etalase::all();
        return view('admin.etalases.index', compact('etalases','menus'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:etalases',
            'menu_id' => 'required',
            'parent_id' => 'required',
        ]);
        Etalase::create([
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
        $request->validate([
            'nameEdit' => 'required',
            'menu_edit' => 'required',
            'parent_edit' => 'required',
        ]);
        $etalase = Etalase::find($id);
        $etalase->update([
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
        $etalase = Etalase::find($id);
        $etalase->delete();
        return back();
    }
    
    public function getChildMenu($id){//JQuery Mengambil parent child berdasarkan Parent Menu yang di pilih
        $menu = Menu::find($id);
        return response(['childs' => $menu->etalases, 'count' => $menu->etalases->count()]);
    }
    
}
