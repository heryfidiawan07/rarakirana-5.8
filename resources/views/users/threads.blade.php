<div class="thread-frame">
    <p class="frame-thread-title">
        <a class="thread-title" href="/thread/{{$thread->slug}}">{{$thread->title}}</a>
        <a class="thread-category" href="/thread/category/{{$thread->category->slug}}">
            <small>{{$thread->category->name}}</small>
        </a>
    </p>
    <p class="frame-thread-category">
        <a href="/user/{{$thread->user->slug}}" class="thread-user">
            <img src="
            @if ($thread->user->biodata)
                @if ($thread->user->biodata->img != null)
                    /users/{{$thread->user->biodata->img}}
                @else
                    /parts/no-image-icon.png
                @endif
            @else
                /parts/no-image-icon.png
            @endif
            " class="img-circle" width="30">
            {{$thread->user->name}}
        </a>
        <small>, {{ date('d F, Y', strtotime($thread->created_at))}}</small>
        - <small><i class="fas fa-comment"></i> {{$thread->comments->count()}}</small>
    </p>
</div>