@if ($user->biodata)
    <div class="media">
        {!! strip_tags(nl2br($user->biodata->description)) !!}
    </div>
@endif

@auth
    @if (Auth::user()->id === $user->id)
        <button type="button" class="btn btn-light btn-sm mt-2" data-toggle="modal" data-target="#editDescription">
            @if ($user->biodata)
                <i class="fas fa-edit"></i>
            @else
                Tambahkan deskripsi tentang anda
            @endif
        </button>

        <div class="modal fade" id="editDescription" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" action="/user/{{$user->slug}}/description">
                            @csrf
                            @if ($user->biodata)
                                <textarea rows="5" name="description" class="form-control mb-1 {{ $errors->has('description') ? ' is-invalid' : '' }}" required>{!! strip_tags(nl2br($user->biodata->description)) !!}</textarea>
                            @else
                                <textarea rows="5" name="description" class="form-control mb-1 {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Tentang anda" required>{{old('description')}}</textarea>
                            @endif
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                            <button class="btn btn-primary btn-sm">Save</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
