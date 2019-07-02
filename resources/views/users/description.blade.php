@if ($user->biodata)
    <div id="text-user-description">{!! nl2br(strip_tags($user->biodata->description)) !!}</div> 
        @auth
            @if (Auth::user()->id === $user->id)
                <i class="fas fa-edit text-primary" id="btn-user-desc-edit"></i> 
                <form method="POST" action="/user/{{$user->slug}}/update/description">
                    @csrf
                    <textarea rows="5" id="textarea-user-description" name="description" class="form-control mb-1" required>{!! strip_tags(nl2br($user->biodata->description)) !!}</textarea>
                    <button class="btn btn-primary btn-sm" id="btn-user-desc-save"><i class="fas fa-paper-plane"></i></button>
                    <button class="btn bg-silver btn-sm" id="btn-user-desc-cancel">Cancel</button>
                </form>
            @endif 
        @endif
@endif
@auth
    @if(Auth::user()->id == $user->id)
        @if (!$user->biodata)
            <form method="POST" action="/user/{{$user->slug}}/create/description">
                @csrf
                <div class="form-group">
                    <textarea name="description" rows="5" class="form-control" placeholder="Tentang anda">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm"><i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        @endif
    @endif
@endif
