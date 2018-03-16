<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38993815-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-38993815-2');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph -->
    <meta property="og:url"                content="https://play.hacktechonline.com" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Play HackTech Online now!" />
    <meta property="og:description"        content="A semi-realistic hacking simulation game, set in a near cyberpunk like future. All you need is a web browser, to be able to play with people from all around the world!" />
    <meta property="og:image"              content="https://play.hacktechonline.com/img/social.png" />

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

        var userToken = "@php echo md5(Auth::id()); @endphp";
    </script>

    @yield('extra-head')
</head>
<body>
@if(Auth::check() && Auth::user()->profile->music == 1)
<script type="text/javascript" src="http://scmplayer.co/script.js"
        data-config="{'skin':'skins/black/skin.css','volume':50,'autoplay':true,'shuffle':true,'repeat':1,'placement':'bottom','showplaylist':false,'playlist':[{'title':'Track 1','url':'https://www.youtube.com/watch?v=0r6C3z3TEKw'},{'title':'Track 2','url':'https://www.youtube.com/watch?v=z7a3gazr3KE'},{'title':'Track 3','url':'https://www.youtube.com/watch?v=szH_1J92JpE'}]}" >
</script>
@endif

    @yield('topbar')
<div id="app">
    <div class="window_wrapper"></div>

    @yield('content')
</div>
    @yield('footer')


    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}?v={{ md5(time()) }}"></script>
    <script src="/js/moduleloader.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="{{ mix('/js/jquery.onenter.js') }}"></script>
    <script src="{{ mix('/js/notification-min.js') }}"></script>
    <script src="{{ mix('/js/echoevents.js') }}"></script>

    @yield('extra-js')

</body>
</html>
