<div class="sw_shop_goback">
    <img class="sw_shop_goback" alt="Back" src="img/back_small.png" /> <span class="small_label sw_shop_goback"> Back to shop</span>
</div>

<div class="spacer-bottom-25"></div>

<div class="sw_shop">
    <span class="title">{{ strtoupper($software->title) }}</span><br>
    <span>Version: <span id="app_version">{{ number_format($software->appModel->version, 1, '.', '') }}</span></span><br>
    <span>{{ $software->description }}</span>

    <div class="spacer-bottom-25"></div>

    <button class="btn buy-app" rel="{{ number_format($software->appModel->version, 1, '.', '') }}" value="{{ $software->moduleID }}">Purchase</button>
</div>
