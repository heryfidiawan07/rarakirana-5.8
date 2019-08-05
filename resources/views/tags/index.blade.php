@extends('layouts.app')

@section('title'){{$tag->title}}@endsection
@section('description'){{$tag->description}}@endsection

@section('content')
<div class="container">
    <h2 class="parent-color bold">{{$tag->name}}</h2>
    
    @if ($tag->products()->count() > 0)
		<div class="row">
            @foreach ($products as $product)
                @include('products.thumb-content')
            @endforeach
            <div class="col-md-12 col-lg-12">
                <p class="text-center">{{$products->links()}}</p>
            </div>
        </div>
    @endif

    @if ($tag->posts()->count() > 0)
	    <div class="row">
	        <div class="col-lg-8 col-md-10 col-sm-12">
	            @foreach ($posts as $post)
	                @include('posts.content-index')
	            @endforeach
	            <div class="col-md-12 mt-3">
	                {{$posts->links()}}
	            </div>
	        </div>
	    </div>
    @endif
	
	@if ($tag->forums()->count() > 0)
	    <div class="row">
	        <div class="col-sm-8 col-md-8 col-lg-9">
	            <div class="row">
	                @foreach ($threads as $thread)
	                    @include('threads.content-index')
	                @endforeach
	                <div class="col-md-12">
	                    {{$threads->links()}}
	                </div>
	            </div>
	        </div>
	    </div>
	@endif

</div>
@endsection