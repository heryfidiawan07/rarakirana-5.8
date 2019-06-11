@extends('layouts.app')

@if ($app)
    @section('image'){{$baseUrl}}/aplication/img/{{$app->img}}@endsection
    @section('title'){{$app->title}}@endsection
    @section('description'){{$app->description}}@endsection
@endif

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home-product-index.css">
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
    <link rel="stylesheet" type="text/css" href="/css/post-index.css">
    <link rel="stylesheet" type="text/css" href="/css/thread-index.css">
@endsection

@section('content')

@include('home.products')

<div class="container">
    @if ($posts->count())
        <h2 class="parent-color bold mt-3">News</h2>
        <div class="row">
            @foreach ($posts->where('menu.status',1) as $post)
                <div class="col-lg-6">
                    @include('posts.content-index')
                </div>
            @endforeach
        </div>
    @endif

    @if ($threads->count())
        <h2 class="parent-color bold mt-5">Threads</h2>
        <div class="row">
            @foreach ($threads->where('category.status',1)->where('status',1) as $thread)
                @include('threads.content-index')
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/home/products.js"></script>
@endsection