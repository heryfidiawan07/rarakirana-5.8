@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Product List</i></span>
    @include('admin.left-sidebar')
    
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-sm" @if ($mainmenus->where('setting',1)->count() == 0 || !$adminAdd || !$etalases->count()) disabled @else href="/admin/product/create" @endif><i class="fas fa-plus"></i> Create Product </a>
                    @if ($mainmenus->where('setting',1)->count() == 0)
                        <p class="text-danger">Please setup menu product !</p>
                    @endif
                    @if (!$adminAdd)
                        <p class="text-danger">Please setup admin address !</p>
                    @endif
                    @if (!$etalases->count())
                        <p class="text-danger">Please setup product etalase !</p>
                    @endif
                </div>
                @if($products->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <th>Img</th><th>Title</th><th>Price</th><th>Etalase</th><th>Type</th><th>Discus</th><th>Created</th><th>User</th><th>Status</th><th>Edit</th><th>Delete</th>
                            @foreach($products as $product)
                                <tr class="table-success">
                                    <td class="text-center bg-light" rowspan="2" style="vertical-align: middle;">
                                        <img @if ($product->pictures->count()) src="/products/thumb/{{$product->pictures[0]->img}}" @else src="/parts/no-image.png" @endif class="dashboard-img">
                                    </td>
                                    <td class="td-250">
                                        <a class="text-link" href="/show/product/{{$product->slug}}">{{$product->title}}</a>
                                        @if ($product->sticky==1)
                                            <small class="text-success">__Sticky product.</small>
                                        @endif
                                    </td>
                                    <td>Rp {{number_format($product->price)}}</td>
                                    <td>{{$product->etalase->name}}</td>
                                    <td>
                                        @if ($product->type==0)
                                            Online
                                        @else
                                            Offline
                                        @endif
                                    </td>
                                    <td>{{$product->comments->count()}}</td>
                                    <td><small>{{ date('d F, Y', strtotime($product->created_at))}}</small></td>
                                    <td class="td-150">
                                        <small><i class="fas fa-user"></i> {{$product->user->name}}</small>
                                    </td>
                                    <td>
                                        @if ($product->status==1)
                                            <p class="text-success">Active</p>
                                        @else
                                            <p class="text-danger">Draft</p>
                                        @endif
                                    </td>
                                    <td><a href="/admin/product/{{$product->id}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a></td>
                                    <td>@include('admin.products.delete')</td>
                                </tr>
                                <tr>
                                    @include('admin.products.quick-edit')
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
                <div class="card-footer">
                    {{$products->links()}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
