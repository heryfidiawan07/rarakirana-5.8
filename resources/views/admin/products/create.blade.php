@extends('admin.layouts.app')

@section('css')    
    <link rel="stylesheet" type="text/css" href="/css/multiple-upload.css">
@endsection

@section('adminContent')

    <span id="panel-name">Create Product</span>    

    <form method="POST" action="/admin/product/store" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" placeholder="Title" value="{{old('title')}}">
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
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
                    <textarea name="description" id="description" class="form-control post-textarea {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="15" placeholder="Description">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="first_price">Price <i><u>Rp</u></i></label>
                    <input type="integer" name="first_price" class="form-control {{ $errors->has('first_price') ? ' is-invalid' : '' }}" placeholder="100.000" value="{{old('first_price')}}">
                    @if ($errors->has('first_price'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_price') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Discount <i><u>Rp</u></i></label>
                    <input type="integer" name="discount" class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="0" value="{{old('discount')}}">
                    @if ($errors->has('discount'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="weight">Weight <i><u>Gram</u></i></label>
                    <input type="integer" name="weight" class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}" placeholder="1000 = 1kg" value="{{old('weight')}}">
                    @if ($errors->has('weight'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('weight') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="etalase_id">Etalase</label>
                    <select class="custom-select {{ $errors->has('etalase_id') ? ' is-invalid' : '' }}" name="etalase_id">
                        @foreach ($etalases as $etalase)
                            @if ($etalase->childs->count())
                                @continue
                            @endif
                            <option value="{{$etalase->id}}" class="from-control">{{$etalase->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Product Type</label>
                    <select class="custom-select {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                        <option value="0" class="from-control">Online</option>
                        <option value="1" class="from-control">Offline</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sticky">Set to sticky</label>
                    <select class="custom-select {{ $errors->has('sticky') ? ' is-invalid' : '' }}" name="sticky">
                        <option value="0" class="from-control">No</option>
                        <option value="1" class="from-control">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                        <option value="1" class="from-control">Active</option>
                        <option value="0" class="from-control">No Active / Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Allowed Comment</label>
                    <select class="custom-select {{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment">
                        <option value="1" class="from-control">Yes</option>
                        <option value="0" class="from-control">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categories">Tags <a href="/admin/tags" class="text-link">Create Tag</a></label>
                    <div class="alert alert-info" id="tag-alert-info">
                        @foreach ($tags as $tag)
                            <div class="checkbox checkbox_{{$tag->id}}">
                                <label class="label-tags"><input type="checkbox" name="tags[]" value="{{$tag->id}}"> {{$tag->name}} </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Publish</button>
                </div>
            </div>
        </div>
    </form>
        
@endsection

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/js/products/mce-product.js"></script>
<script type="text/javascript" src="/js/multiple-upload.js"></script>
@endsection