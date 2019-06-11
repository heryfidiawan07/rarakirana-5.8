<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @if ($app)
        <meta name="author"           content="{{$app->author}}" />
        <meta name="company"           content="{{$app->company}}" />
    @endif

    <title>@yield('title')</title>
	
    <meta name="url"           content="{{Request::url()}}" />
    <meta name="image"         content="@yield('image')" />
    <meta name="title"         content="@yield('title')" />
    <meta name="description"   content="@yield('description')" />

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:description" content="@yield('description')" />

    <meta name="google-signin-client_id" content="524555026329-duc32e6en3f62mhdak03hi5scguviu9f.apps.googleusercontent.com">
    <meta name="google-site-verification" content="rK6CP-v6mdxCyRsKxtxqVLId-j6lyrtkFSZ5xPRB3jI" />

    <link href="<?php if($app) echo $baseUrl.'/aplication/thumb/'.$app->img ?>" rel='shortcut icon'>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    {{-- Animate CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.1/animate.min.css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/social-media.css" rel="stylesheet">
    <link href="/css/hery_dev__.css" rel="stylesheet">
    @yield('css')
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120528530-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-120528530-1');
    </script>
    <!-- Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="content">
            @yield('content')
            <div class="cart-success"></div>
        </main>
        
        <div class="footer">
            @include('layouts.footer')
        </div>
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="/js/app.js"></script>
    {{-- <script src="/js/bootstrap.js"></script> --}}
    <script src="/js/share.js"></script>
    <script src="/js/addToCart.js"></script>
    @yield('js')
</body>
</html>
