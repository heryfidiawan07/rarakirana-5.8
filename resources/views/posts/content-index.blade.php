<div class="post-frame">
    <div class="row">
        <div class="col-md-5 col-sm-5">
            <img @if ($post->img == null) src="/parts/no-image.png" @else src="/posts/thumb/{{$post->img}}" @endif height="150" class="rounded mx-auto d-block post-img-index">
        </div>
        <div class="col-md-7 col-sm-7">
            <p>
                <a class="parent-color text-link bold text-size-10 hover-unbold @if($post->sticky==1) sticky @endif" href="/read/post/{{$post->slug}}">{{str_limit($post->title, 100)}}</a>
            </p>
            @if ($post->tags)
                @foreach ($post->tags as $tag)
                    <a href="/tag/{{$tag->slug}}" class="post-tags"><small>{{$tag->name}}</small></a>
                @endforeach
            @endif
        </div>
    </div>
</div>