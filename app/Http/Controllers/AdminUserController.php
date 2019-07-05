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
        $users = User::OrderBy('id');

        return Datatables::of($users)
        ->editColumn('name', function ($user) {
            return '<a href="/user/'.$user->slug.'" class="text-link">'.$user->name.'</a>';
        })
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
        ->rawColumns(['name', 'confirmed'])
        ->make(true);
    }
    
}
