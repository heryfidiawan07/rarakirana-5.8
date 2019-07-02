<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target=".inbox-{{$inbox->id}}">Delete !</a>

<div class="modal fade inbox-{{$inbox->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Delete Inbox {{strip_tags($inbox->title)}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="/admin/inbox/{{$inbox->id}}/delete" class="btn btn-danger btn-sm">Delete !</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>