@extends('layouts.app')

@section('image'){{ config('app.url') }}/posts/img/{{$post->img}}@endsection
@section('title'){{$post->title}}@endsection
@section('description'){{strip_tags(str_limit($post->description, 145))}}@endsection

@section('content')
<div class="container">
    
    <div class="row">
        
        <div class="col-md-7">
            <p class="parent-color bold text-size-15 text-center">{{$post->title}}</p>
            @if ($post->img != null)
                <img src="/posts/img/{{$post->img}}" alt="{{$post->title}}">
            @endif
            <div class="mb-3">
                {!! nl2br($post->description) !!}
                <i class="far fa-calendar-alt"></i> {{ date('d F, Y', strtotime($post->created_at))}}
            </div>
            @if ($post->comment==1)
                <hr>
                @include('posts.comment')
            @endif
        </div>

        <div class="col-md-5">
            @if ($post->menu->contact==1)
                @include('parts.global-form')
            @endif
        </div>
        
    </div>

</div>
@endsection
