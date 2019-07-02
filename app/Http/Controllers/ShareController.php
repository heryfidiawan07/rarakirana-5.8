<?php

namespace App\Http\Controllers;

use Auth;
use App\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }

    public function store(Request $request){
        Share::create([
            'class' => $request->share_class,
            'link' => $request->share_link,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function delete($id){
        $share = Share::find($id);
        $share->delete();
        return back();
    }
}
