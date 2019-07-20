<a class="btn btn-primary btn-sm" href="" data-toggle="modal" data-target=".create-menu"><i class="fas fa-plus"></i> Add Menu</a>

<div class="modal fade create-menu" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/menu/store">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <small class="text-success"><i>search engine optimization</i></small></label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description <small class="text-success"><i>search engine optimization</i></small></label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input name="icon" type="text" class="form-control" id="icon" placeholder="ex: fas fas-envelope" value="{{old('icon')}}">
                    </div>
                    <div class="form-group">
                        <label for="setting">Setting</label>
                        <select class="custom-select" name="setting">
                            @foreach ($roles as $key => $role)
                                <option value="{{$key}}">{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="setting">Parent</label>
                        <select class="custom-select" name="parent_id">
                            <option value="0" class="from-control">Default</option>
                            @foreach ($menus->where('parent_id',0)->where('setting',0) as $menu)
                                <option value="{{$menu->id}}" class="from-control">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact">Include contact form ?</label>
                        <select class="custom-select" name="contact">
                            <option value="0" class="from-control">No</option>
                            <option value="1" class="from-control">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>