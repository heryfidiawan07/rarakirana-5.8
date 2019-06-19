<div class="col-lg-6 col-md-12 col-sm-12">
    <div class="card mb-3">
        <div class="card-body">
            <p class="frame-text-3em">
                <a class="parent-color text-link bold" href="/thread/{{$thread->slug}}">{{str_limit($thread->title, 100)}}</a>
            </p>
            <footer class="blockquote-footer">
                <a href="/thread/category/{{$thread->category->slug}}">
                    <cite>{{$thread->category->name}}</cite>
                </a>
            </footer>
        </div>
        <div class="card-footer">
            <a href="/user/{{$thread->user->slug}}" class="text-link">
                <img src="/users/{{$thread->user->img}}" class="img-circle-xs">
                {{$thread->user->name}}
            </a>
            <small>, {{ date('d F, Y', strtotime($thread->created_at))}}</small>
            - <small><i class="fas fa-comment"></i> {{$thread->comments->count()}}</small>
        </div>
    </div>
</div>