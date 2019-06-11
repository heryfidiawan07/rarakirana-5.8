<div id="img-profile">
    <img src="/users/{{$user->img}}" class="img-thumbnail mb-2">
    @auth
        @if (Auth::user()->id === $user->id)
            <form method="POST" action="/user/{{$user->slug}}/upload/img" enctype="multipart/form-data">
                @csrf
                <div class="input-group input-group-sm">
                    <div class="custom-file">
                        <input type="file" name="img" class="custom-file-input" id="input-user-img" aria-describedby="input-img">
                        <label class="custom-file-label" for="input-user-img">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="input-img">Save</button>
                    </div>
                </div>
            </form>
        @endif
    @endif
</div>