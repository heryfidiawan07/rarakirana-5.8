<a class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target=".edit-tag-{{$tag->id}}"><i class="fas fa-edit"></i></a>

<div class="modal fade edit-tag-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Edit Tag {{$tag->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/tag/{{$tag->id}}/update">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nameEdit">Name</label>
                        <input name="nameEdit" type="text" class="form-control" id="nameEdit" placeholder="Name" value="{{$tag->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="titleEdit">Title <small class="success"><i>search engine optimization</i></small></label>
                        <input name="titleEdit" type="text" class="form-control" id="titleEdit" placeholder="Title" value="{{$tag->title}}">
                    </div>
                    <div class="form-group">
                        <label for="descEdit">Description <small class="success"><i>search engine optimization</i></small></label>
                        <textarea name="descEdit" id="descEdit" class="form-control" rows="3" placeholder="Description">{!! strip_tags($tag->description) !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="iconEdit">Icon - <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Icon gallery</a></label>
                        <input name="iconEdit" type="text" class="form-control" id="iconEdit" placeholder="ex: fas fas-envelope" value="{{$tag->icon}}">
                    </div>
                    <div class="form-group">
                        <label for="status_menu_edit">Set to list menu ?</label>
                        <select class="custom-select" name="status_menu_edit" id="status_menu_edit">
                            @if ($tag->status_menu==1)
                                <option value="1" class="from-control">Yes</option>
                            @endif
                            <option value="0" class="from-control">No</option>
                            <option value="1" class="from-control">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm btn-update-tag">
                            <i class="fas fa-paper-plane"></i> Update
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>