<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target=".delete-tag-{{$tag->id}}"><i class="fas fa-trash"></i></a>

<div class="modal fade delete-tag-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Delete tag {{$tag->title}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <a class="btn btn-danger btn-sm" href="/admin/tag/{{$tag->id}}/delete">Delete !</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>