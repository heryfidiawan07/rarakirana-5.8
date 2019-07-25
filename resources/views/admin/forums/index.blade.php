@extends('admin.layouts.app')

@section('adminContent')

    <span id="panel-name">Forum</span>
    
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                @if($forums->count())
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <th>Title</th><th>Parent Menu</th><th>Created</th><th>User</th><th>Status</th><th>Action</th>
                            @foreach($forums as $forum)
                                <tr>
                                    <td><a class="text-link" href="/thread/{{$forum->slug}}">{{$forum->title}}</a></td>
                                    <td>
                                        <a class="text-link" href="/thread/category/{{$forum->category->slug}}">{{$forum->category->name}}</a>
                                    </td>
                                    <td><small>{{ date('d F, Y', strtotime($forum->created_at))}}</small></td>
                                    <td>
                                        <a class="text-link" href="/user/{{$forum->user->slug}}">
                                            <small><i class="fas fa-user"></i> {{$forum->user->name}}</small>
                                        </a>
                                    </td>
                                    <td>
                                        @if ($forum->status==1)
                                            <p class="text-success">Active</p>
                                        @else
                                            <p class="text-danger">Banned</p>
                                        @endif
                                    </td>
                                    <td>@include('admin.forums.modal-status')</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
                <div class="card-footer"><small>{{$forums->links()}}</small></div>
            </div>
        </div>

    </div>

@endsection
