<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} Admin Panel</title>

    <meta name="google-signin-client_id" content="524555026329-duc32e6en3f62mhdak03hi5scguviu9f.apps.googleusercontent.com">
    <meta name="google-site-verification" content="rK6CP-v6mdxCyRsKxtxqVLId-j6lyrtkFSZ5xPRB3jI" />

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="/css/hery_dev__.css" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    @yield('css')

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    {{-- Animate CSS --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.1/animate.min.css">
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

    <div class="wrapper">
        
        @include('admin.layouts.left-sidebar')

        <!-- Page Content  -->
        <div id="content">

            @include('admin.layouts.navbar')
            
            @yield('adminContent')

        </div><!-- End Page Content  -->
    </div><!-- Page Wrapper  -->

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    @yield('js')

    <script type="text/javascript">
        $(document).ready(function () {
            
            $('#navbar-panel-name').text($('#panel-name').text());

            $('#dismiss').on('click', function () {
                $('.dsh-text').hide();
                $('#dismiss').hide();
                $('#openSidebar').show();
                // $('#openSidebar').css('display','unset');
                $('#sidebar').css('width','auto');
                $('#content').css('padding-left','65px');
                $('#sidebar-name').hide();
                // console.log(document.getElementById("sidebar").clientWidth);
            });

            $('#openSidebar').on('click', function () {
                $('#sidebar').css('width','auto');
                $('#content').css('padding-left','180px');
                $('.dsh-text').show();
                $('#dismiss').show();
                $('#openSidebar').hide();
                $('#sidebar-name').show();
                // console.log(document.getElementById("sidebar").clientWidth);
            });
        });
    </script>
</body>

</html>