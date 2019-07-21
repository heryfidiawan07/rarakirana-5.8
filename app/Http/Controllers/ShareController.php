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
        $data = request()->validate([
            'share' => 'required',
        ]);
        $share = new Share;
        $class = $share->shares();
        $url   = $share->urls();
        foreach ($request->share as $key) {
            Share::create([
                'class' => $class[$key],
                'link' => $url[$key],
                'user_id' => Auth::user()->id,
            ]);
        }
        return back();
    }

    public function delete($id){
        $share = Share::find($id);
        $share->delete();
        return back();
    }
}
