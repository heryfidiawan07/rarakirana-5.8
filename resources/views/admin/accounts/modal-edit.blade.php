<a href="" class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target=".account_edit_{{$account->id}}">Edit</a>

<div class="modal fade account_edit_{{$account->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Edit Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/account/{{$account->id}}/update">
                @csrf
                    <div class="form-group">
                        <label>Bank</label>
                        <input type="text" name="bankEdit" class="form-control" value="{{$account->bank}}" required>
                    </div>
                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="nameEdit" class="form-control" value="{{$account->name}}" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="no_rekEdit" class="form-control" value="{{$account->no_rek}}" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <select name="statusEdit" class="form-control" required>
                            @if ($account->status==0)
                                <option value="0">No Active</option>
                            @endif
                            <option value="1">Active</option>
                            <option value="0">No Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-sm" value="Save">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>