@extends('layouts.app')

@section('title'){{$category->title}}@endsection
@section('description'){{$category->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/thread-index.css">
@endsection

@section('content')
<div class="container">
    <h2 id="page-name">{{$category->name}}</h2>
    <div class="row">

        <div class="col-md-3">
            @auth
                <a href="/thread/create" class="btn btn-primary block" id="btn-thread-create">Create</a>
            @endif
            <table class="table table-hover">
                <th class="bg-parent-color text-white">CATEGORY</th>
                @foreach ($categories->where('parent_id',0)->where('status',1) as $category)
                    <tr>
                        <td>
                            <a class="parent-color text-link bold block" href="/thread/category/{{$category->slug}}">{{$category->name}}</a>
                        </td>
                        @if ($category->childs->count())
                            @foreach ($category->childs->where('status',1) as $child)
                                <tr>
                                    <td>
                                        <a class="parent-color text-link bold block ml-3" href="/thread/category/{{$child->slug}}">{{$child->name}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col-md-9">
            <div class="row">
                @foreach ($threads->where('category.status',1)->where('status',1) as $thread)
                    @include('threads.content-index')
                @endforeach
                <div class="col-md-12">
                    {{$threads->links()}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
