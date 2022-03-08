<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    {{-- <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('argon/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('argon/css/argon.css?v=1.2.0') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}" />
</head>
<body>
    @include('includes.sidenav')
    <div class="main-content" id="panel">
        @include('includes.top')
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    @include('includes.message')
                    @yield('header')
                </div>
            </div>
        </div>
        <div class="container-fluid mt--6">
            @yield('content')
            @include('includes.footer')
            @include('includes.delete')
        </div>
    </div>
    <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('argon/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="{{ asset('argon/js/argon.js?v=1.2.0') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}" defer></script>  
    @include('includes.scripts')
    @yield('more-scripts')
</body>
</html>


{{-- <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-maa.css') }}" />
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>   
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>   
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>  
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>  
</head>
<body>
    @include('includes.download')
    <div id="app">
        @include('includes.nav')
        <div class="container">
            @include('includes.message')
            @yield('content')
        </div>
    </div>
    @include('includes.function')
</body>
</html> --}}
