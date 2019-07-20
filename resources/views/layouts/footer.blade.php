@include('parts.social-media-share')

<div class="bg-parent-color p-2">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-5">
                @if ($app)
                    {{-- <img src="/aplication/thumb/{{$app->img}}" id="app-image-footer"> --}}
                    <p class="text-white">{!! strip_tags(nl2br($app->description)) !!}</p>
                @endif
                @if ($follows->count())
                    <p class="text-white">
                        Follow:
                        @foreach ($follows as $follow)
                            <a href="/{{$follow->link}}"><i class="{{$follow->class}}"></i></a>
                        @endforeach
                    </p>
                @endif
            </div>
            
            <div class="col-md-2"></div>

            <div class="col-md-5 text-center">
                @if ($mainmenus)
                    @foreach($mainmenus->where('parent_id',0) as $menu)
                        @if ($menu->childs->count())
                            @continue
                        @endif
                        <p class="inline-block pl-3 pr-3">
                            <a href="/{{$menu->slug}}" class="text-white text-link hover-unbold bold">
                                <i class="{{$menu->icon}}"></i> {{$menu->name}}
                            </a>
                        </p>
                    @endforeach
                @endif
                @guest
                    <p class="inline-block pl-3 pr-3">
                        <a href="/login" class="text-white bold">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </p>
                    <p class="inline-block pl-3 pr-3">
                        <a href="/register" class="text-white bold text-link hover-unbold">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </p>
                    @include('parts.socialite-login')
                @else
                    <p class="inline-block pl-3 pr-3">
                        <a href="/user/{{Auth::user()->slug}}" class="text-white bold text-link hover-unbold">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </p>
                    <p class="inline-block pl-3 pr-3">
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-white bold text-link hover-unbold">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </p>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>
            
            <div class="col-md-12 text-center">
                <p class="text-white">
                    Copyright {{date('Y')}}. <a href="/" class="text-white text-link">@if ($app){{$app->name}}@endif</a>
                </p>
                @if ($app)
                    <p class="text-white">
                        <small>By <a class="text-link text-white" href="mailto:{{$app->email}}"><i>{{$app->author}}</i></a></small>
                    </p>
                @endif
            </div>

        </div>
    </div>
</div>
