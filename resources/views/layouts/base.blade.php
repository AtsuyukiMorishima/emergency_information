<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href='{{asset('/css/bootstrap.min.css')}}'>
    <link rel="stylesheet" href='{{ mix('/css/app.css') }}'>
	@yield('template_linked_css')
    <link rel="stylesheet" href='{{asset('/css/event.css')}}'>
     <!--<link rel="stylesheet" href='css/w3-fix.css'> -->
</head>

<body id="@yield('body_id')" class="pb-2">
    <header class="navbar navbar-light bg-light fixed-top shadow cust-header">
        <div class="container-fluid">
            @yield('navbar')
        </div>
    </header>
    <main class="container main-body">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                @yield('contents')
            </div>
        </div>
    </main>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    @yield('script')

</body>

</html>