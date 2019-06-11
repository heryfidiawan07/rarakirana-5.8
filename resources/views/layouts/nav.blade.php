<div class="container">
    <div id="header" class="row">
        <div class="col-md-12">
            <p id="app-name"><a href="/">{{$app ? $app->name : 'Rarakirana'}}</a></p>
            @if ($app)
                {{-- <img src="/aplication/thumb/{{$app->img}}" alt="{{$app->name}}" id="app-image" class="rounded"> --}}
                <p id="app-name">{{$app->title}}</p>
            @endif
        </div>
        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search..." name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary btn-search" type="button" id="button-addon2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            @if ($follows->count())
                <p class="float-right mt-2">
                    <b>Follow: </b>
                    @foreach ($follows as $follow)
                        <a href="/{{$follow->link}}"><i class="{{$follow->class}}"></i></a>
                    @endforeach
                </p>
            @endif
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg fixed-top bg-parent-color">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto pt-3 pt-lg-0">
                @if ($mainmenus->where('setting',1)->count())
                    <li class="nav-item">
                        <a href="/product/carts" class="nav-link text-white bold hover-unbold">
                            <i class="fas fa-shopping-cart"></i>
                            Cart <span class="itemCart">{{Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link text-white bold hover-unbold" href="/">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                @if ($mainmenus)
                    @foreach($mainmenus->where('parent_id',0) as $menu)
                        <li @if ($menu->childs->count()) class="nav-item dropdown" @else class="nav-item" @endif>
                            <a @if ($menu->childs->count()) class="nav-link dropdown-toggle text-white bold hover-unbold" href="#" id="menu_{{$menu->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @else class="nav-link text-white bold hover-unbold" href="/{{$menu->slug}}" @endif>
                                <i class="{{$menu->icon}}"></i> {{$menu->name}}
                            </a>
                            @if ($menu->childs->count())
                                <div class="dropdown-menu border-0 shadow animate slideIn" aria-labelledby="menu_{{$menu->id}}">
                                    @foreach ($menu->childs->where('status',1) as $child)
                                        <a class="dropdown-item parent-color bold hover-unbold" href="/{{$child->slug}}">
                                            <i class="{{$child->icon}}"></i> {{$child->name}}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                @endif
                @if ($maintags->count())
                    @foreach ($maintags as $tag)
                        <li class="nav-item">
                            <a class="nav-link text-white bold hover-unbold" href="/tag/{{$tag->slug}}">
                                <i class="{{$tag->icon}}"></i> {{$tag->name}}
                            </a>
                        </li>
                    @endforeach
                @endif
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white bold hover-unbold" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white bold hover-unbold" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> {{ __('Register') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white bold hover-unbold" href="#" id="auth" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu border-0 shadow animate slideIn" aria-labelledby="auth">
                            @if (Auth::user()->admin())
                                <a class="dropdown-item parent-color bold hover-unbold" href="/admin">
                                    <i class="fas fa-tachometer-alt"></i> Admin Panel
                                </a>
                            @endif
                            <a class="dropdown-item parent-color bold hover-unbold" href="/user/{{ Auth::user()->slug }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <a class="dropdown-item parent-color bold hover-unbold" href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
