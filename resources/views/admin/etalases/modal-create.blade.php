<a class="btn btn-primary btn-sm" @if ($mainmenus->where('setting',1)->count()) href="" data-toggle="modal" data-target=".create-etalase" @else disabled @endif><i class="fas fa-plus"></i> Add Etalase</a>

<div class="modal fade create-etalase" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Add New Etalase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/etalase/store">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{old('name')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title <small class="success"><i>search engine optimization</i></small></label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{old('title')}}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description <small class="success"><i>search engine optimization</i></small></label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input name="icon" type="text" class="form-control" id="icon" placeholder="ex: fas fas-envelope" value="{{old('icon')}}">
                    </div>
                    <div class="form-group">
                        <label for="menu_id">Menu Parent</label>
                        <select class="custom-select" name="menu_id" id="menu-parent">
                            <option value="0" class="from-control">Select !</option>
                            @foreach ($menus as $menu)
                                <option value="{{$menu->id}}" class="from-control" data-url="/admin/etalase/parent-menu/{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Etalase Parent</label>
                        <select class="custom-select" name="parent_id" id="default-parent-etalase">
                            <option value="0" class="from-control">Default</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm" id="btn-etalase-create" disabled="true"><i class="fas fa-paper-plane"></i> Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>