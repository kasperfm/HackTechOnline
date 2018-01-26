<link rel="stylesheet" href="{{ $cssPath }}mygateway.css" type="text/css" />

<div id="mygateway-content">
    @include('modules.system.mygateway.views.overview')
</div>

<script type="text/javascript" src="{{ $jsPath }}mygateway.js?v={{ md5(time()) }}"></script>