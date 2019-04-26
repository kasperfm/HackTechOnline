<link rel="stylesheet" href="{{ $cssPath }}mygateway.css" type="text/css" />

<div id="mygateway-content">
    @include('Modules.System.MyGateway.Views.overview')
</div>

<script type="text/javascript" src="{{ $jsPath }}mygateway.js?v={{ useJSCache() }}"></script>