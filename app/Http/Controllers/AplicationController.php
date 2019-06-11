<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Aplication;
use Illuminate\Http\Request;

class AplicationController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }
    
    public function index(){
        $aplication = Aplication::first();
        return view('admin.aplication.index', compact('aplication'));
    }
    
    public function store(Request $request){
        $img  = $request->file('img');
        if (!empty($img)) {
            $extends = $img->getClientOriginalextension();
            $imgName = str_slug($request->name).'.'.$extends;
            $path    = $img->getRealPath();
            $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb->save(public_path("aplication/thumb/". $imgName));
            $img->save(public_path("aplication/img/". $imgName));
        }else {
            $imgName = 'no-image.png';
        }
        Aplication::create([
            'img' => $imgName,
            'name' => $request->name,
            'title' => $request->title,
            'description' => Purifier::clean($request->description),
            'telp' => $request->telp,
            'hp' => $request->hp,
            'email' => $request->email,
            'address' => $request->address,
            'author' => $request->author,
            'company' => $request->company,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function edit($id){
        $aplication = Aplication::find($id);
        return view('admin.aplication.edit', compact('aplication'));
    }
    
    public function update(Request $request, $id){
        $aplication = Aplication::find($id);
        $img  = $request->file('img');
        if (!empty($img)) {
            if ($aplication->img != 'no-image.png') {
                $oldImg   = public_path("aplication/img/".$aplication->img);
                $oldThumb = public_path("aplication/thumb/".$aplication->img);
                if (file_exists($oldImg)) {
                    File::delete($oldImg);
                    File::delete($oldThumb);
                }
            }
            $extends = $img->getClientOriginalextension();
            $imgName = str_slug($request->name).'.'.$extends;
            $path    = $img->getRealPath();
            $img     = Image::make($path)->resize(null, 630, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb    = Image::make($path)->resize(null, 300, function ($constraint) {
                            $constraint->aspectRatio();
                        });
            $thumb->save(public_path("aplication/thumb/". $imgName));
            $img->save(public_path("aplication/img/". $imgName));
        }else {
            $imgName = $aplication->img;
        }
        $aplication->update([
            'img' => $imgName,
            'name' => $request->name,
            'title' => $request->title,
            'description' => Purifier::clean($request->description),
            'telp' => $request->telp,
            'hp' => $request->hp,
            'email' => $request->email,
            'address' => $request->address,
            'author' => $request->author,
            'company' => $request->company,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/admin/aplication');
    }
    
}
