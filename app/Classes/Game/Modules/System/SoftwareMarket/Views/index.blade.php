<link rel="stylesheet" href="{{ $cssPath }}softwaremarket.css" type="text/css" />

<div id="softwaremarket-content">
    @include('modules.system.softwaremarket.views.overview')
</div>

<script type="text/javascript" src="{{ $jsPath }}softwaremarket.js?v={{ md5(time()) }}"></script>
