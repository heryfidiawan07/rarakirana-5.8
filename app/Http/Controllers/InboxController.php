<?php

namespace App\Http\Controllers;

use App\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }
    
    public function index(){
        $inboxes = Inbox::paginate(20);
        return view('admin.inbox.index', compact('inboxes'));
    }
    
    public function delete($id){
        $inbox = Inbox::find($id);
        $inbox->delete();
        return back();
    }
    
}
