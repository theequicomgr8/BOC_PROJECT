<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" >
    
    <!-- CSRF Token -->
    <meta name="csrf-token1" content="{{ csrf_token() }}">
    <title>Print Media</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">



     <link rel="stylesheet" href="{{ asset('theme/css/style.css')}}" >
    <link href="{{ asset('theme/css/dist/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('theme/css/responsive.css')}}">

</head>
<body>
    <div id="app" >
 @if(session()->missing('UserID'))

        <div id="wrap" class="animsition backlayer" style="opacity: 1;">
        <header class="layerLeft">
        <div class="logo"><a href=""><img alt="" src="{{URL::to('theme/images/logo.png')}}" title=""></a></div>
        </header>
        </div>
        @endif

         <main class="py-4">
            @yield('content')
        </main>
    </div>



    <script src="{{ asset('theme/js/jquery.min.js')}}"></script>
    <script src="{{ asset('theme/js/popper.js')}}"></script>
    <script src="{{ asset('theme/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('theme/js/main.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="{{ asset('theme/js/jquery.backstretch.min.js')}} "></script>
    <script>
            $.backstretch("/theme/images/bg_v2.jpg", { speed: 500 });
    </script>

</body>
</html>
