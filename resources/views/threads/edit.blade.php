@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-9">
            <form method="POST" action="/thread/{{$thread->slug}}/update">
            @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{$thread->title}}">
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="custom-select" name="category_id">
                        <option value="{{$thread->category->id}}">{{$thread->category->name}}</option>
                        @foreach ($categories as $category)
                            @if ($category->childs->count())
                                @continue
                            @endif
                            <option value="{{$category->id}}" class="from-control">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control post-textarea" rows="15" placeholder="Description">{{$thread->description}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Publish</button>
                </div>
            </form>
        </div>
        
        <div class="col-md-3">
        </div>

    </div>

</div>
@endsection
