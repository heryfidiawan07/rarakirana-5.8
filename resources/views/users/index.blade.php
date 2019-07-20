@extends('layouts.app')

@section('title'){{$user->name}}@endsection
@section('image'){{$user->img}}@endsection
@if ($user->biodata)
@section('description'){{$user->biodata->description}}@endsection
@endif

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
    <link rel="stylesheet" type="text/css" href="/css/upload.css">
@endsection

@section('content')
    <div class="container">
        
        <div class="row">
            <div class="col-md-10 mb-5">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        @include('users.img')
                    </div>
                    <div class="col-md-8 col-sm-8">
                        @include('users.name')
                        <p><small><i>Joined: {{ date('d F, Y', strtotime($user->created_at))}}</i></small></p>
                        @include('users.description')
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @foreach ($threads as $thread)
                        @include('threads.content-index')
                    @endforeach
                    <div class="col-md-12">{{$threads->links()}}</div>
                </div>
            </div>
            <div class="col-md-4">
                @auth
                    @if (Auth::user()->id == $user->id)
                        @include('users.transaction')
                    @endif
                @endif
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/upload.js"></script>
@endsection