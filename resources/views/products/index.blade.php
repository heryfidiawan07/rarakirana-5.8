@extends('layouts.app')

@section('title'){{$menu->title}}@endsection
@section('description'){{$menu->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
@endsection

@section('content')
    <div class="container">
        <h2 class="parent-color bold">{{$menu->name}}</h2>
        <div class="row">
            
            <div class="col-md-3">
                <table class="table table-hover mb-5">
                    <th class="bg-parent-color text-white">ETALASE</th>
                    @foreach ($menu->etalases->where('parent_id',0)->where('status',1) as $etalase)
                        <tr>
                            <td>
                                <a class="parent-color bold block text-link" href="/product/etalase/{{$etalase->slug}}">{{$etalase->name}}</a>
                            </td>
                            @if ($etalase->childs->count())
                                @foreach ($etalase->childs->where('status',1) as $child)
                                    <tr>
                                        <td>
                                            <a class="parent-color bold block text-link ml-3" href="/product/etalase/{{$child->slug}}">{{$child->name}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
            
            <div class="col-md-9">
                @if ($products->count())
                    <div class="row">
                        @foreach ($products->where('etalase.status',1)->where('status',1) as $product)
                            @include('products.thumb-content')
                        @endforeach
                        <div class="col-md-12 col-lg-12">
                            <p class="text-center">{{$products->links()}}</p>
                        </div>
                    </div>
                @endif
                @if ($menu->contact==1)
                    @include('parts.global-form')
                @endif
            </div>

        </div>
    </div>
@endsection
