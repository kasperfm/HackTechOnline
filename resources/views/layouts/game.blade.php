<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HackTech Online') }}</title>

    <!-- Styles -->
    <link href="/css/misc.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/ui/jqueryui-theme.css" rel="stylesheet" type="text/css" />
    <link href="/css/ui/hto-theme.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @yield('topbar')
@include('modules.demo.module')
    @yield('footer')

    <!-- Scripts -->
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/jquery-ui-bundle.js') }}"></script>
    <script src="{{ mix('/js/jquery.onenter.js') }}"></script>
    <script src="{{ mix('/js/notification-min.js') }}"></script>
    <script src="{{ mix('/js/init.js') }}"></script>
</body>
</html>
