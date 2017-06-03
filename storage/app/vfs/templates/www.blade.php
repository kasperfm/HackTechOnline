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
    <link href="/css/webpage.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="/js/jquery.slim.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('extra-head')

    <script>
        $(document).ready(function() {
            $('.link').on("click", function() {
                if(parent.$(".www-address").val().slice(-1) == '/'){
                    parent.$(".www-address").val(parent.$(".www-address").val() + $(this).attr('goto'));
                }else{
                    parent.$(".www-address").val(parent.$(".www-address").val() + '/' + $(this).attr('goto'));
                }

                parent.navigate(parent.$(".www-address").val());
            });
        });
    </script>
</head>

<body>
    @yield('content')
</body>

</html>
