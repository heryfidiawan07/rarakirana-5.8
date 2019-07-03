<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Yajra\Datatables\Datatables;

class AdminUserController extends Controller
{
    public function users()
    {
        return view('admin.users.index');
    }

    public function getUsers()
    {   
        $users = User::select(['id', 'name', 'email', 'created_at', 'status']);
        $status = ['No Active', 'Active', 'Banned !'];

        return Datatables::of($users)
        ->setRowClass(function ($user) {
            return $user->status % 2 == 0 ? 'alert-danger' : 'alert-success';
        })
        ->editColumn('created_at', function ($user) {
            return $user->created_at->format('Y/m/d');
        })
        ->make(true);
    }
    
}
