<div class="col-md-12 col-lg-6">
    <div class="thread-frame">
        <p class="frame-text-3em">
            <a class="parent-color text-link bold" href="/thread/{{$thread->slug}}">{{str_limit($thread->title, 100)}}</a>
        </p>
        <p>
            <a class="btn btn-xs bg-parent-color text-white" href="/thread/category/{{$thread->category->slug}}">
                <small>{{$thread->category->name}}</small>
            </a>
        </p>
        <p>
            <a href="/user/{{$thread->user->slug}}" class="text-link">
                <img src="/users/{{$thread->user->img}}" class="img-circle-xs" width="30">
                {{$thread->user->name}}
            </a>
            <small>, {{ date('d F, Y', strtotime($thread->created_at))}}</small>
            - <small><i class="fas fa-comment"></i> {{$thread->comments->count()}}</small>
        </p>
    </div>
</div>