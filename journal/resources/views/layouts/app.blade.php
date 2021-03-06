<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <meta property="og:title" content="" />
    <meta property="og:image" content="{{asset('assets/preview.jpg')}}" />
    <meta property="og:description" content=""/>

    <!-- Scripts -->
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.js')}}"></script>
    @stack('scripts')
    @stack('styles')
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Styles -->

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <link href="{{ asset('assets/favicon/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/utils.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">



</head>
<body>

@yield('side_menu')

@include('include.header')


@auth
    <div class="content" id="main_content" >
        @yield('content')
    </div>

@endauth
@guest
    <div class="content" style="padding-left: 20px; width: 100%">
        @yield('content')
    </div>
@endguest







</body>
</html>
