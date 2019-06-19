<dl class="row">
    <dt class="col-md-3 bg-light text-center">
        <img @if ($post->img == null) src="/parts/no-image.png" @else src="/posts/thumb/{{$post->img}}" @endif height="100" class="post-img-index">
    </dt>
    <dt class="col-md-9">
        <p class="frame-text-3em">
            <a class="parent-color text-link bold text-size-10 hover-unbold @if($post->sticky==1) sticky @endif" href="/read/post/{{$post->slug}}">{{str_limit($post->title, 100)}}</a>
        </p>
        <footer class="blockquote-footer">
            <cite>{{ date('d F, Y', strtotime($post->created_at))}}</cite>
        </footer>
    </dt>
</dl>