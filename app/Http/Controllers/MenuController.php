<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

	public function __construct()
	{
		return $this->middleware('admin');
	}

	public function index()
	{	
        $roles = new Menu;
        $roles = $roles->roles();
		$menus = Menu::orderBy('setting','DESC')->get();
		return view('admin.menus.index', compact('menus','roles'));
	}

	public function store(Request $request){
		$data = request()->validate([
			'name' => 'required|unique:menus',
			'setting' => 'required',
			'parent_id' => 'required',
            'contact' => 'required',
		]);
		//fas fa-square-full -> icon default
		Menu::create([
			'name' => $request->name,
			'slug' => str_slug($request->name),
			'title' => $request->title,
			'description' => Purifier::clean($request->description),
			'setting' => $request->setting,
			'icon' => $request->icon,
			'parent_id' => $request->parent_id,
            'contact' => $request->contact,
			'user_id' => Auth::user()->id,
		]);
		return back();
	}
	
    public function update(Request $request, $id){
        $data = request()->validate([
            'nameEdit' => 'required',
            'settingEdit' => 'required',
            'parent_edit' => 'required',
        ]);
        $menu = Menu::find($id);
        $menu->update([
            'name' => $request->nameEdit,
            'slug' => str_slug($request->nameEdit),
            'title' => $request->titleEdit,
            'description' => Purifier::clean($request->descriptionEdit),
            'setting' => $request->settingEdit,
            'icon' => $request->iconEdit,
            'parent_id' => $request->parent_edit,
            'contact' => $request->contact_edit,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function delete($id){
        $menu = Menu::find($id);
        $menu->delete();
        return back();
    }
    
}
