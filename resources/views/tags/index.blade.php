@extends('layouts.app')

@section('title'){{$tag->title}}@endsection
@section('description'){{$tag->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/post-index.css">
@endsection

@section('content')
<div class="container">
        <h2 class="parent-color bold">{{$tag->name}}</h2>
        
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @foreach ($posts->where('status',1) as $post)
                    @include('posts.content-index')
                @endforeach
                <div class="col-md-12 mt-3">
                    {{$posts->links()}}
                </div>
            </div>
        </div>

</div>
@endsection