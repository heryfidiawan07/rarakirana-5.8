<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target=".edit-etalase-{{$parent->id}}">
    <i class="fas fa-edit"></i>
</a>

<div class="modal fade edit-etalase-{{$parent->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Etalase {{$parent->name}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/etalase/{{$parent->id}}/update">
                    {{csrf_field()}}
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
                        <textarea name="descriptionEdit" id="description" class="form-control" rows="3">{{$parent->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input name="iconEdit" type="text" class="form-control" id="icon" placeholder="ex: fas fas-envelope" value="{{$parent->icon}}">
                    </div>
                    <div class="form-group">
                        <label for="menu_edit">Menu Parent <span class="text-danger">*</span></label>
                        <select class="custom-select" name="menu_edit">
                            <option value="{{$parent->menu->id}}">{{$parent->menu->name}}</option>
                            @foreach ($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_edit">Etalase Parent</label>
                        <select class="custom-select" name="parent_edit">
                            @if ($parent->parent)
                                <option value="{{$parent->parent->id}}" class="from-control">{{$parent->parent->name}}</option>
                            @endif
                            @if ($parent->childs->count())
                                <option value="0" class="from-control">Default</option>
                            @else
                                @if ($parent->childs->count()==0)
                                    <option value="0" class="from-control">Default</option>
                                @endif
                                @foreach ($etalases->where('parent_id',0)->where('id','<>',$parent->id) as $etalase)
                                    <option value="{{$etalase->id}}" class="from-control">{{$etalase->name}}</option>
                                @endforeach
                            @endif
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