<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target=".delete-account-{{$account->id}}"><i class="fas fa-trash"></i></a>

<div class="modal fade delete-account-{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Delete Account  {{$account->back}}, {{$account->name}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="/admin/account/{{$account->id}}/delete" class="btn btn-danger btn-sm">Delete !</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>