@extends('layouts.app')

@if ($app)
    @section('image'){{ config('app.url') }}/application/img/{{$app->img}}@endsection
    @section('title'){{$app->title}}@endsection
    @section('description'){{$app->description}}@endsection
@endif

@section('content')

<div class="container">
    @if ($posts->count())
        <h2 class="parent-color bold mt-3">News</h2>
        <div class="row">
            @foreach ($posts->where('menu.status',1) as $post)
                <div class="col-lg-6">
                    @include('posts.content-index')
                </div>
            @endforeach
            {{$posts->links()}}
        </div>
    @endif
</div>
@endsection
