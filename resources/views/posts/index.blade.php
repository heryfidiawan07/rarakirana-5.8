@extends('layouts.app')

@section('title'){{$menu->title}}@endsection
@section('description'){{$menu->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/post-index.css">
@endsection

@section('content')
<div class="container">
        <h2 class="parent-color bold">{{$menu->name}}</h2>
        
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @foreach ($posts->where('status',1) as $post)
                    @include('posts.content-index')
                @endforeach

                <div class="col-md-12 col-lg-12">
                    {{$posts->links()}}
                </div>

                @if ($menu->contact==1)
                    @include('parts.global-form')
                @endif
            </div>
        </div>

</div>
@endsection
