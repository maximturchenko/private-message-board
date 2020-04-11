<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Сайтсофт</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>
<body>

@include('layouts.navigation')


<div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            @yield('content')
        </div>
    </div>

</body>
</html>







