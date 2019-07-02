<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }
    
    public function index(){
        $application = Application::first();
        return view('admin.application.index', compact('application'));
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
            $thumb->save(public_path("application/thumb/". $imgName));
            $img->save(public_path("application/img/". $imgName));
        }else {
            $imgName = 'no-image.png';
        }
        Application::create([
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
        $application = Application::find($id);
        return view('admin.application.edit', compact('application'));
    }
    
    public function update(Request $request, $id){
        $application = Application::find($id);
        $img  = $request->file('img');
        if (!empty($img)) {
            if ($application->img != 'no-image.png') {
                $oldImg   = public_path("application/img/".$application->img);
                $oldThumb = public_path("application/thumb/".$application->img);
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
            $thumb->save(public_path("application/thumb/". $imgName));
            $img->save(public_path("application/img/". $imgName));
        }else {
            $imgName = $application->img;
        }
        $application->update([
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
        return redirect('/admin/application');
    }
    
}
