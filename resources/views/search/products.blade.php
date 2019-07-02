@extends('layouts.app')

@if ($app)
    @section('image'){{$baseUrl}}/aplication/img/{{$app->img}}@endsection
    @section('title'){{$app->title}}@endsection
    @section('description'){{$app->description}}@endsection
@endif

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/home-product-index.css">
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
@endsection

@section('content')

    @include('home.products')
    @if ($products->count())
        <div class="row">
            <div class="col-md-12">{{$products->link()}}</div>
        </div>
    @endif
</div>
@endsection
