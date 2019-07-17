<h3>
    {{$user->name}}
    @auth
        @if (Auth::user()->id === $user->id)
            <button class="btn btn-light btn-sm" type="button" data-toggle="collapse" data-target="#editName" aria-expanded="false" aria-controls="editName"><i class="fas fa-edit"></i></button>
        @endif
    @endif
</h3>
@auth
    @if (Auth::user()->id === $user->id)
        <div class="collapse mt-2 mb-3" id="editName">
            <form method="POST" action="/user/{{$user->slug}}/edit/name">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" name="name" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{$user->name}}" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <div class="input-group-append">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endif
