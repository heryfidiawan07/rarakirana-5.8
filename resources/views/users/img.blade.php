<div id="img-profile">
    <figure class="figure">
        <img src="/users/{{$user->img}}" class="img-thumbnail mb-2">
        @auth
            @if (Auth::user()->id === $user->id)
                <figcaption class="figure-caption text-center">
                    <i class="fas fa-edit imgCaptionEdit" type="button" data-toggle="modal" data-target="#editPhoto"></i>
                </figcaption>
            @endif
        @endif
    </figure>
    @auth
        @if (Auth::user()->id === $user->id)
            <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form method="POST" action="/user/{{$user->slug}}/upload/img" enctype="multipart/form-data">
                                @csrf
                                @include('parts.upload')
                                <input type="submit" class="btn btn-primary btn-sm" value="Save">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>