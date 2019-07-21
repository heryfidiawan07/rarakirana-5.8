<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target=".edit-menu-{{$parent->id}}">
    <i class="fas fa-edit"></i>
</a>

<div class="modal fade edit-menu-{{$parent->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu {{$parent->name}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/menu/{{$parent->id}}/update">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="nameEdit" type="text" class="form-control" id="name" value="{{$parent->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <small class="text-success"><i>search engine optimization</i></small></label>
                        <input name="titleEdit" type="text" class="form-control" id="title" value="{{$parent->title}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description <small class="text-success"><i>search engine optimization</i></small></label>
                        <textarea name="descriptionEdit" id="description" class="form-control" rows="3">{{strip_tags($parent->description)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="icon">
                            Icon
                            @if ($parent->icon != null)
                                <i class="{{$parent->icon}}"></i> - 
                            @endif
                        </label>
                        <input name="iconEdit" type="text" class="form-control" id="icon" placeholder="ex: fas fas-envelope" value="{{$parent->icon}}">
                    </div>
                    <div class="form-group">
                        <label for="setting">Setting</label>
                        <select class="custom-select" name="settingEdit">
                            <option value="{{$parent->setting}}">{{$roles[$parent->setting]}}</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{$key}}">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="setting">Parent</label>
                        <select class="custom-select" name="parent_edit">
                            <option value="0" class="from-control">Default</option>
                            @if ($parent->childs->count()<1)
                                @foreach ($menus->where('id','<>',$parent->id)->where('setting',0)->where('parent_id',0) as $menu)
                                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact_edit">Include contact form ?</label>
                        <select class="custom-select" name="contact_edit">
                            @if ($parent->contact == 1)
                                <option value="1" class="from-control">Yes</option>
                            @endif
                            <option value="0" class="from-control">No</option>
                            <option value="1" class="from-control">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select" name="status">
                            @if ($parent->status == 0)
                                <option value="0" class="from-control">No Active</option>
                            @endif
                            <option value="1" class="from-control">Active</option>
                            <option value="0" class="from-control">No Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">Update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>