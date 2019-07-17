<a href="/read/post/{{$post->slug}}" class="text-link">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img @if ($post->img == null) src="/parts/no-image.png" @else src="/posts/thumb/{{$post->img}}" @endif class="card-img" alt="{{$post->title}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="frame-text-3em">
                        <h6 class="card-title parent-color bold @if($post->sticky==1) sticky @endif">{{str_limit($post->title, 100, '...')}}</h6>
                    </div>
                    <p class="card-text">
                        <small class="text-muted">
                            <footer class="blockquote-footer">
                                <cite>{{ date('d F, Y', strtotime($post->created_at))}}</cite>
                            </footer>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</a>