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

        return Datatables::of($users)
        ->addIndexColumn()
        ->setRowClass(function ($user) {
            return $user->status % 2 == 0 ? 'alert-danger' : 'alert-success';
        })
        ->editColumn('created_at', function ($user) {
            return date('d-F-Y', strtotime($user->created_at));
        })
        ->editColumn('status', function ($user) {
            if ($user->status == 0) return 'No Active';
            if ($user->status == 1) return 'Active';
            if ($user->status == 2) return 'Banned !';
        })
        ->make(true);
    }
    
}
