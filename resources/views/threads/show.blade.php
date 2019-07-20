@extends('layouts.app')

@section('title'){{$thread->title}}@endsection
@section('description'){{strip_tags(str_limit($thread->description, 145))}}@endsection

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-md-3">
            @auth
                <a href="/thread/create" class="btn btn-primary block">Create</a>
            @endif
            <table class="table table-hover">
                <th class="bg-parent-color text-white">CATEGORY</th>
                @foreach ($categories->where('parent_id',0)->where('status',1) as $category)
                    <tr>
                        <td>
                            <a class="parent-color bold text-link block" href="/thread/category/{{$category->slug}}">{{$category->name}}</a>
                        </td>
                        @if ($category->childs->count())
                            @foreach ($category->childs->where('status',1) as $child)
                                <tr>
                                    <td>
                                        <a class="parent-color bold text-link block ml-3" href="/thread/category/{{$child->slug}}">{{$child->name}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="col-md-7">
            <p class="parent-color text-size-20 bold">{{$thread->title}}</p>
            <p>{!! nl2br(strip_tags($thread->description)) !!}</p>
            <p>
                <a class="btn btn-sm bg-parent-color text-white bold" href="/thread/category/{{$thread->category->slug}}">
                    <small>{{$thread->category->name}}</small>
                </a>
                <a href="/user/{{$thread->user->slug}}" class="thread-user">
                    <img src="/users/{{$thread->user->img}}" class="img-circle-xs">
                    {{$thread->user->name}}
                </a>
                <small>, {{ date('d F, Y', strtotime($thread->created_at))}}</small>
                - <small><i class="fas fa-comment"></i> {{$thread->comments->count()}}</small>
                @auth
                    @if ($thread->user->id === Auth::user()->id)
                        <a href="/thread/{{$thread->slug}}/edit" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                @endif
            </p>
            @if ($thread->comment==1)
                @include('threads.comment')
            @endif
        </div>

    </div>
</div>
@endsection
