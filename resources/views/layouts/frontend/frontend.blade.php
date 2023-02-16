<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ url('/images/logos/favicon.png') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}"/>
    <link rel="stylesheet" href="{{url('test/css/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{url('backend/plugins/fontawesome-free/css/all.min.css')}}">

    <style>
     
    </style>
</head>
<body>
<div id="app">
    @include('layouts.frontend.menu')

    @yield('content')

    @include('layouts.frontend.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{url('test/js/swiper-bundle.min.js')}}"></script>
<script src="{{url('backend/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('backend/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
@stack('styles')
@stack('scripts')
</body>
</html>




