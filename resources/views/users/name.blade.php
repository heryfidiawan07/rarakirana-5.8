@auth
    @if (Auth::user()->id === $user->id)
        <form method="POST" action="/user/{{$user->slug}}/edit/name">
            @auth @csrf @endif
            <div class="input-group input-group-sm">
                <b id="text-name" class="text-size-20">{{$user->name}}</b>
                <button class="btn btn-xs text-primary" id="btn-user-name-edit"><i class="fas fa-edit"></i></button>
                <input type="text" name="name" id="input-name" class="form-control" value="{{$user->name}}" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" id="btn-user-name-save">Save</button>
                    <button class="btn bg-silver" id="btn-user-name-cancel">Cancel</button>
                </div>
            </div>
        </form>
    @endif
@endif