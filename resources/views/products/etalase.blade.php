@extends('layouts.app')

@section('title'){{$etalase->title}}@endsection
@section('description'){{$etalase->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
@endsection

@section('content')
    <div class="container">
        <h2 class="parent-color bold">{{$etalase->name}}</h2>
        <div class="row">
            
            <div class="col-sm-3">
                @if ($etalases->count())
                    <table class="table table-hover">
                        <th class="bg-parent-color text-white bold">ETALASE</th>
                        @foreach ($etalases->where('status',1) as $etalase)
                            <tr>
                                <td>
                                    <a class="parent-color text-link block bold" href="/product/etalase/{{$etalase->slug}}">{{$etalase->name}}</a>
                                </td>
                                @if ($etalase->childs->count())
                                    @foreach ($etalase->childs->where('status',1) as $child)
                                        <tr>
                                            <td>
                                                <a class="parent-color text-link block bold ml-3" href="/product/etalase/{{$child->slug}}">{{$child->name}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>

            <div class="col-sm-9">
                @if ($products->count())
                    <div class="row">
                        @foreach ($products as $product)
                            @include('products.thumb-content')
                        @endforeach
                        <div class="col-md-12 col-lg-12">
                            <p class="text-center">{{$products->links()}}</p>
                        </div>
                    </div>
                @endif
                @if ($etalase->contact==1)
                    @include('parts.global-form')
                @endif
            </div>

        </div>
    </div>
@endsection
