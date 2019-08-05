<?php

namespace App\Http\Controllers;

use Auth;
use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(){
        return $this->middleware('admin');
    }

    public function index(){
        $accounts = Account::all();
        return view('admin.accounts.index', compact('accounts'));
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'bank' => 'required|min:3',
            'name' => 'required|min:5',
            'no_rek' => 'required|min:7',
            'status' => 'required',
        ]);
        Account::create([
            'bank' => $request->bank,
            'name' => $request->name,
            'no_rek' => $request->no_rek,
            'status' => $request->status, 
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'bankEdit' => 'required|min:3',
            'nameEdit' => 'required|min:5',
            'no_rekEdit' => 'required|min:7',
            'statusEdit' => 'required',
        ]);
        $account = Account::find($id);
        $account->update([
            'bank' => $request->bankEdit,
            'name' => $request->nameEdit,
            'no_rek' => $request->no_rekEdit,
            'status' => $request->statusEdit, 
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    
    public function delete($id){
        $account = Account::find($id);
        $account->delete();
        return back();
    }
    
}
