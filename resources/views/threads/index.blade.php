@extends('layouts.app')

@section('title'){{$menu->title}}@endsection
@section('description'){{$menu->description}}@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/thread-index.css">
@endsection

@section('content')
<div class="container">
    <h2 class="parent-color bold">{{$menu->name}}</h2>
    <div class="row">

        <div class="col-sm-4 col-md-4 col-lg-3">
            @auth
                <a href="/thread/create" class="btn btn-primary block">Create</a>
            @endif
            <table class="table table-hover">
                <th class="bg-parent-color text-white">CATEGORY</th>
                @foreach ($menu->categories->where('parent_id',0)->where('status',1) as $category)
                    <tr>
                        <td>
                            <a class="text-link parent-color bold block" href="/thread/category/{{$category->slug}}">{{$category->name}}</a>
                        </td>
                        @if ($category->childs->count())
                            @foreach ($category->childs->where('status',1) as $child)
                                <tr>
                                    <td>
                                        <a class="text-link parent-color bold block ml-3" href="/thread/category/{{$child->slug}}">{{$child->name}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-9">
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
