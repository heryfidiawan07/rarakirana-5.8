@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">User List</i></span>
    @include('admin.left-sidebar')

    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body">
                        {{$user->name}}
                    </div>
                    <div class="card-footer">
                        Joined: <small>{{ date('d F, Y', strtotime($user->created_at))}}</small>
                        __
                        @if ($user->status == 0)
                            <span class="text-muted bold">No Active</span>
                        @elseif ($user->status == 1)
                            <span class="text-success bold">Active</span>
                        @elseif ($user->status == 2)
                            <span class="text-danger bold">Banned</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12">{{$users->links()}}</div>
    </div>

</div>
@endsection
