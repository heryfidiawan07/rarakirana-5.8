<?php

namespace App\Http\Controllers;

use Auth;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }

    public function store(Request $request){
        Follow::create([
            'class' => $request->follow_class,
            'link' => $request->follow_link,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function update(Request $request, $id){
        $follow = Follow::find($id);
        $follow->update([
            'link' => $request->follow_link_edit,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function delete($id){
        $follow = Follow::find($id);
        $follow->delete();
        return back();
    }

}
