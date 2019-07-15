@extends('layouts.app')

@section('image'){{ config('app.url') }}/products/img/{{$product->pictures[0]->img}}@endsection
@section('title'){{$product->title}}@endsection
@section('description'){{strip_tags(str_limit($product->description, 145))}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/carousel-product-show.css">
@endsection

@section('content')
<div class="container">

    <div class="row">

        <div class="col-md-3">

            @if ($etalases->count())
                <table class="table table-hover">
                    <th class="bg-parent-color text-white">ETALASE</th>
                    @foreach ($etalases->where('status',1) as $etalase)
                        <tr>
                            <td>
                                <a class="parent-color bold block text-link" href="/product/etalase/{{$etalase->slug}}">{{$etalase->name}}</a>
                            </td>
                            @if ($etalase->childs->count())
                                @foreach ($etalase->childs->where('status',1) as $child)
                                    <tr>
                                        <td>
                                            <a class="parent-color bold block text-link ml-4" href="/product/etalase/{{$child->slug}}">{{$child->name}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tr>
                    @endforeach
                </table>
            @endif

        </div>

        <div class="col-md-9">
            
            <div class="row">
                <div class="col-md-7 text-center">
                    <div id="frame-img-product-show">
                        @include('products.image-slide')
                    </div>
                </div>
                <div class="col-md-5">
                    <p class="text-size-15 parent-color">{{$product->title}}</p>
                    <p class="italic bold">
                        @if ($product->discount > 0)
                            <s>Rp {{number_format($product->first_price)}}</s>
                        @endif
                    </p>
                    <p class="text-orange text-size-15 bold">
                        Rp {{number_format($product->price)}}
                        @if ($product->discount > 0)
                            <span class="text-sale">Sale</span>
                        @endif
                    </p>
                    <p class="text-center">
                        @if ($product->type == 0)
                            <a class="btn-addToCart btn bg-parent-color text-white width-48 hover-unbold" href="/add-to-cart/{{$product->slug}}">AddToCart</a>
                            <a class="btn bg-parent-color text-white width-48 hover-unbold" href="/buy-product/{{$product->slug}}">Buy</a>
                            <div class="mt-3">
                                <span class="mr-3"><b><i class="fas fa-weight"></i> {{$product->weight/1000}} kg<b></span>
                                <span class="mr-3"><i class="fas fa-truck"></i> {{$delivery}}</span>
                            </div>
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-9">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="discus-tab" data-toggle="tab" href="#discus" role="tab" aria-controls="discus" aria-selected="false">Diskusi {{$product->comments->count()}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Ulasan {{$product->reviews->count()}}</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <p>{!! nl2br($product->description) !!}</p>
                        </div>
                        <div class="tab-pane fade" id="discus" role="tabpanel" aria-labelledby="discus-tab">
                            @if ($product->comment==1)
                                @include('products.comment')
                            @endif
                        </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            @include('products.reviews')
                        </div>
                    </div>
                </div>
            </div>
            @if ($product->type == 1)
                <div class="p-3 mb-2 bg-secondary text-white">Kirim Formulir</div>
                @include('products.offline-form')
            @endif
        </div>
        
    </div>
        
</div>
@endsection
