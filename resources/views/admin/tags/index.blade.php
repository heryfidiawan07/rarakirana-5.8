@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Tag List</i></span>
    @include('admin.left-sidebar')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.tags.modal-create')
                </div>
                @if($tags->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <th>Icon</th><th>Name</th><th>Title</th><th>Description</th><th>Menu Status</th><th>Created</th><th>User</th><th>Edit</th><th>Delete</th>
                            @foreach($tags as $tag)
                                <tr>
                                    <td align="center">
                                        <i class="{{$tag->icon}}"></i>
                                    </td>
                                    <td>
                                        <a class="text-link" href="/tag/{{$tag->slug}}">{{$tag->name}}</a>
                                    </td>
                                    <td>{{$tag->title}}</td>
                                    <td>{{strip_tags($tag->description)}}</td>
                                    <td>
                                        @if ($tag->status_menu==1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td><small>{{ date('d F, Y', strtotime($tag->created_at))}}</small></td>
                                    <td><small><i class="fas fa-user"></i> {{$tag->user->name}}</small></td>
                                    <td>@include('admin.tags.modal-edit')</td>
                                    <td>@include('admin.tags.modal-delete')</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
