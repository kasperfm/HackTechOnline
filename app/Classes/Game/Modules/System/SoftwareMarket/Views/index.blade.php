<link rel="stylesheet" href="{{ $cssPath }}softwaremarket.css" type="text/css" />

<div id="softwaremarket-content">
    @include('Modules.System.SoftwareMarket.Views.overview')
</div>

<script type="text/javascript" src="{{ $jsPath }}softwaremarket.js?v={{ useJSCache() }}"></script>
