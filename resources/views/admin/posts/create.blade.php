@extends('admin.layouts.app')

@section('css')    
    <link rel="stylesheet" type="text/css" href="/css/upload.css">
@endsection

@section('adminContent')

    <span id="panel-name">Create Post</span>

    <form method="POST" action="/admin/post/store" enctype="multipart/form-data">
        <div class="row">
            @csrf
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
                    <label for="menu_id">Parent Menu</label>
                    <select class="custom-select {{ $errors->has('menu_id') ? ' is-invalid' : '' }}" name="menu_id">
                        @foreach ($menus->where('setting',0) as $menu)
                            @if ($menu->childs->count())
                                @continue
                            @endif
                            <option value="{{$menu->id}}" class="from-control">{{$menu->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('menu_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('menu_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control post-textarea {{ $errors->has('description') ? ' is-invalid' : '' }}" rows="25" placeholder="Description">{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="img">Image</label>
                    @include('parts.upload')
                </div>
                <div class="form-group">
                    <label for="sticky">Set to sticky</label>
                    <select class="custom-select {{ $errors->has('sticky') ? ' is-invalid' : '' }}" name="sticky">
                        <option value="0" class="from-control">No</option>
                        <option value="1" class="from-control">Yes</option>
                    </select>
                    @if ($errors->has('sticky'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sticky') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="custom-select {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                        <option value="1" class="from-control">Active</option>
                        <option value="0" class="from-control">No Active / Draft</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="comment">Allowed Comment</label>
                    <select class="custom-select {{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment">
                        <option value="1" class="from-control">Yes</option>
                        <option value="0" class="from-control">No</option>
                    </select>
                    @if ($errors->has('comment'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="categories">Tags <a href="/admin/tags">Create Tag</a></label>
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
<script src="/js/posts/mce-post.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
@endsection