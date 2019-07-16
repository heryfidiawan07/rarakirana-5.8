@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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
                    <div class="table-responsive p-2">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Etalase</th>
                                    <th>Type</th>
                                    <th>Discus</th>
                                    <th>Created</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td class="td-100">
                                        <img @if ($product->pictures->count() < 1)src="/products/thumb/no-image.png"@else src="/products/thumb/{{$product->pictures[0]->img}}"@endif width="100">
                                    </td>
                                    <td class="td-150">
                                        <a href="/show/product/{{$product->slug}}" class="text-link @if($product->sticky==1) sticky @endif">{{str_limit($product->title, 50)}}</a>
                                    </td>
                                    <td class="td-150">Rp {{number_format($product->price)}}</td>
                                    <td class="td-100">
                                        <a href="/product/etalase/{{$product->etalase->slug}}">{{$product->etalase->name}}</a>
                                    </td>
                                    <td>
                                        @if ($product->type==0)
                                            <i class="text-success">Online</i>
                                        @else
                                            <i class="text-muted">Offline</i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->comment==1)
                                            <i class="text-success">Yes</i>
                                        @else
                                            <i class="text-danger">No</i>
                                        @endif
                                    </td>
                                    <td class="td-100"><small>{{ date('d F, Y', strtotime($product->created_at))}}</small></td>
                                    <td class="td-100">
                                        <i class="fas fa-user"></i> 
                                        {{str_limit($product->user->name, 10)}}
                                    </td>
                                    <td>
                                        @if ($product->status == 0)
                                            <i class="text-danger">Draft</i>
                                        @else
                                            <i class="text-success">Publish</i>
                                        @endif
                                    <td>
                                        <a href="/admin/product/'.$product->id.'/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>@include('admin.products.delete')</td>
                                </tr>
                                <tr>
                                    <td>@include('admin.products.quick-edit')</td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                        </table>
                    </div>
                <div class="card-footer">{{$products->links()}}</div>
            </div>
        </div>

    </div>
</div>
@endsection
