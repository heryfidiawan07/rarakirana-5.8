<?php

namespace App\Http\Controllers;

use App\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }
    
    public function index(){
        $forums = Forum::latest()->paginate(10);
        return view('admin.forums.index', compact('forums'));
    }
    
    public function banned($id){
        $forum = Forum::find($id);
        $forum->update([
            'status' => 0,
        ]);
        return back();
    }
    
    public function delete($id){
        $forum = Forum::find($id);
        $forum->delete();
        return back();
    }
    
}
