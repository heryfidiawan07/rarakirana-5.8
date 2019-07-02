@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="/css/multiple-upload.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Edit Product</i></span>
    @include('admin.left-sidebar')

    <div class="row">

        <form method="POST" action="/admin/product/{{$product->id}}/update" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" placeholder="Title" value="{{$product->title}}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        @foreach ($product->pictures as $pict)
                            <div class="product-image-{{$pict->id}}" style="display: inline-block; border: 1px solid grey; padding: 5px 5px; margin-bottom: 10px;">
                                <div class="text-center">
                                    <img src="/products/thumb/{{$pict->img}}" height="100" style="margin-bottom: 5px;">
                                </div>
                                <div class="text-center">
                                    <div class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash btn-trash-pict" data-id="{{$pict->id}}" data-img="{{$pict->img}}" data-toggle="modal" data-target=".delete-pict"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @include('admin.products.modal-picture-delete')
                    </div>
                    <div class="form-group">
                        <label for="img">Image</label>
                        @if(session('warning'))
                            <div class="alert alert-warning">
                                {{session('warning')}}
                            </div>
                        @endif
                        @include('parts.multiple-upload')
                        @if ($errors->has('img'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('img') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control post-textarea {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="15" placeholder="Description">{{$product->description}}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Price <i><u>Rp</u></i></label>
                        <input type="integer" name="first_price" class="form-control {{ $errors->has('first_price') ? ' is-invalid' : '' }}" value="{{$product->first_price}}">
                        @if ($errors->has('first_price'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_price') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Discount <i><u>Rp</u></i></label>
                        <input type="integer" name="discount" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" value="{{$product->discount}}">
                        @if ($errors->has('discount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('discount') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight <i><u>Gram</u></i></label>
                        <input type="integer" name="weight" class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" value="{{$product->weight}}">
                        @if ($errors->has('weight'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('weight') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="etalase_id">Etalase</label>
                        <select class="custom-select" name="etalase_id">
                            <option value="{{$product->etalase->id}}" class="form-control {{ $errors->has('etalase_id') ? ' is-invalid' : '' }}">{{$product->etalase->name}}</option>
                            @foreach ($etalases as $etalase)
                                <option value="{{$etalase->id}}" class="from-control">{{$etalase->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Product Type</label>
                        <select class="custom-select {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                            @if ($product->type==1)
                                <option value="1" class="from-control">Offline</option>
                            @endif
                            <option value="0" class="from-control">Online</option>
                            <option value="1" class="from-control">Offline</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sticky">Set to sticky</label>
                        <select class="custom-select {{ $errors->has('sticky') ? ' is-invalid' : '' }}" name="sticky">
                            @if ($product->sticky==1)
                                <option value="1" class="from-control">Yes</option>
                            @endif
                            <option value="0" class="from-control">No</option>
                            <option value="1" class="from-control">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                            @if ($product->status==0)
                                <option value="0" class="from-control">No Active / Draft</option>
                            @endif
                            <option value="1" class="from-control">Active</option>
                            <option value="0" class="from-control">No Active / Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Allowed Comment</label>
                        <select class="custom-select {{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment">
                            @if ($product->comment==0)
                                <option value="0" class="from-control">No</option>
                            @endif
                            <option value="1" class="from-control">Yes</option>
                            <option value="0" class="from-control">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Update</button>
                    </div>
                </div>
            </div>
        </form>
            
    </div>
</div>
@endsection

@section('js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="/js/products/mce-product.js"></script>
    <script type="text/javascript" src="/js/multiple-upload.js"></script>
    <script type="text/javascript" src="/js/admin-product-pictures.js"></script>
@endsection