@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Category List</i></span>
    @include('admin.left-sidebar')
    
	<div class="row">

		<div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.categories.modal-create')
                    @if (!$mainmenus->where('setting',2)->count())
                        <div class="alert alert-danger mt-1">Please setup menu for forum !</div>
                    @endif
                </div>
				@if($menus->count())
					<div class="table-responsive">
						<table class="table table-hover">
							<th>Edit</th><th>Name</th><th>Threads</th><th>Title</th><th>Description</th><th>Created</th><th>User</th><th>Delete</th>
                            @foreach ($menus as $menu)
                                <tr class="table-warning bold">
                                    <td>
                                        <button class="btn hery-btn-default btn-sm" disabled data-toggle="tooltip" data-placement="top" title="Menu Parent"><i class="fas fa-list-alt"></i></button>
                                    </td>
                                    <td>
                                        <a class="text-link" href="/thead/category/{{$menu->slug}}">
                                            {{$menu->name}}
                                        </a>
                                    </td>
                                    <td>{{$menu->forums->count()}}</td>
                                    <td>{{$menu->title}}</td>
                                    <td>{{strip_tags($menu->description)}}</td>
                                    <td><small>{{ date('d F, Y', strtotime($menu->created_at))}}</small></td>
                                    <td><small><i class="fas fa-user"></i> {{$menu->user->name}}</small></td>
                                    <td>
                                        <button class="btn hery-btn-default btn-sm" disabled data-toggle="tooltip" data-placement="top" title="Menu Parent"><i class="fas fa-list-alt"></i></button>
                                    </td>
                                </tr>
    							@foreach ($menu->categories->where('parent_id',0) as $parent)
    								<tr @if ($parent->status==0)class="text-danger" @endif>
    									<td>@include('admin.categories.modal-edit')</td>
    									<td>
                                            <a class="text-link" href="/thead/category/{{$parent->slug}}">
                                                <i class="{{$parent->icon}} ml-3"></i> 
                                                _{{$parent->name}}
                                            </a>
                                        </td>
                                        <td>{{$parent->forums->count()}}</td>
                                        <td>{{$parent->title}}</td>
                                        <td>{{strip_tags($parent->description)}}</td>
                                        <td><small>{{ date('d F, Y', strtotime($parent->created_at))}}</small></td>
                                        <td><small><i class="fas fa-user"></i> {{$parent->user->name}}</small></td>
                                        <td>@include('admin.categories.modal-delete')</td>
                                        @if ($parent->childs->count())
                                            @foreach ($parent->childs as $child)
                                                <tr @if ($child->parent->status==0 || $child->status==0) class="text-danger" @endif>
                                                    <td>@include('admin.categories.child-modal-edit')</td>
                                                    <td>
                                                        <a class="text-link" href="/thead/category/{{$child->slug}}">
                                                            <i class="{{$child->icon}} ml-5"></i> 
                                                            <i>__{{$child->name}}</i>
                                                        </a>
                                                    </td>
                                                    <td>{{$child->forums->count()}}</td>
                                                    <td>{{$child->title}}</td>
                                                    <td>{{strip_tags($child->description)}}</td>
                                                    <td><small>{{ date('d F, Y', strtotime($child->created_at))}}</small></td>
                                                    <td><small><i class="fas fa-user"></i> {{$child->user->name}}</small></td>
                                                    <td>@include('admin.categories.child-modal-delete')</td>
                                                </tr>
                                            @endforeach
                                        @endif
    								</tr>
    							@endforeach
                            @endforeach
						</table>
					</div>
				@endif
            </div>
		</div>

	</div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/forum/category-get-child-menu.js"></script>
@endsection