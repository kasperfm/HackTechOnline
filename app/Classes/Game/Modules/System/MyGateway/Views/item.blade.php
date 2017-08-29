<img class="hw_shop_goback" alt="Back" src="img/back_small.png" /> <span class="small_label hw_shop_goback"> Back to gateway</span>

<br />
<br />

<div class="pane hw_gw_shop">
    <img src="modules/img/mygateway/{{ $partType }}.png" alt="Upgrade" />
    <span class="title">{{ strtoupper($partType) }} UPGRADE</span>
    <div class="hw_shop_list">
        <ul>
            @foreach($upgradeList as $upgradePart)
                <li rel="{{$upgradePart['id']}}" class="hw_shop_list_item"><span style="float: left">$ {{$upgradePart['price']}}</span><span style="width: 100px; font-weight:bold;">{{ $upgradePart['name'] }}</span><span style="float: right;">{{$upgradePart['value']}} {{$upgradePart['valueType']}}</span></li>
            @endforeach
        </ul>
    </div>
</div>
