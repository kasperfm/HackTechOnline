<img class="sw_shop_goback" alt="Back" src="img/back_small.png" /> <span class="small_label sw_shop_goback"> Back to shop</span>

<br />
<br />

<div class="sw_shop">
    <span class="title">{{ strtoupper($software->title) }}</span><br>
    <span>Version: <span id="app_version">@php echo number_format($software->version, 1, '.', '') @endphp</span></span><br>
    <span>{{ $software->description }}</span>
    <hr>
    <button class="buyApp" value="{{ $software->id }}">Buy software</button>
</div>
