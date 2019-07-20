@include('admin.header')
    
    <span id="panel-name">Menu</span>
            
	<div class="row">

		<div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.menus.modal-create')
                </div>
				@if($menus->count())
					<div class="table-responsive">
						<table class="table table-hover">
							<th>Edit</th><th>Name</th><th>Title</th><th>Description</th><th>Created</th><th>User</th><th>Delete</th>
							@foreach($menus->where('parent_id',0) as $parent)
								<tr @if ($parent->status==0)class="text-danger" @endif>
									<td>@include('admin.menus.modal-edit')</td>
									<td>
                                        <a class="text-link" href="/{{$parent->slug}}">
                                            <i class="{{$parent->icon}}"></i> {{$parent->name}}
                                        </a>
                                        <small>
                                            <i> - <u>{{$roles[$parent->setting]}}</u></i>
                                        </small>
                                    </td>
                                    <td>{{$parent->title}}</td>
                                    <td>{{strip_tags($parent->description)}}</td>
                                    <td><small>{{ date('d F, Y', strtotime($parent->created_at))}}</small></td>
                                    <td><small><i class="fas fa-user"></i> {{$parent->user->name}}</small></td>
                                    <td>@include('admin.menus.modal-delete')</td>
                                    @if ($parent->childs->count())
                                        @foreach ($parent->childs as $child)
                                            <tr>
                                                <td>@include('admin.menus.child-modal-edit')</td>
                                                <td>
                                                    <a href="/{{$child->slug}}" @if ($child->parent->status==0 || $child->status==0) class="text-danger" @endif>
                                                        <i class="{{$child->icon}} ml-4"></i> 
                                                        <i>_{{$child->name}}</i>
                                                    </a>
                                                    <small>
                                                        <i> - <u>{{$roles[$child->setting]}}</u></i>
                                                        @if ($child->contact==1)
                                                            <i> - <u>Contact</u></i>
                                                        @endif
                                                    </small>
                                                </td>
                                                <td>{{$child->title}}</td>
                                                <td>{{strip_tags($child->description)}}</td>
                                                <td><small>{{ date('d F, Y', strtotime($child->created_at))}}</small></td>
                                                <td><small><i class="fas fa-user"></i> {{$child->user->name}}</small></td>
                                                <td>@include('admin.menus.child-modal-delete')</td>
                                            </tr>
                                        @endforeach
                                    @endif
								</tr>
							@endforeach
						</table>
					</div>
				@endif
            </div>
		</div>

	</div>

@include('admin.footer')
