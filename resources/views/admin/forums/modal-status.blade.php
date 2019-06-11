<a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target=".admin-forum-{{$forum->id}}"> Admin Status ?</a>

<div class="modal fade admin-forum-{{$forum->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Update Status {{$forum->title}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="/admin/forum/{{$forum->id}}/banned" class="btn btn-warning btn-sm">Banned !</a>
                <a href="/admin/forum/{{$forum->id}}/delete" class="btn btn-danger btn-sm">Delete !</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>