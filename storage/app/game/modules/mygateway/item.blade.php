<img class="hw_shop_goback" alt="Back" src="img/back_small.png" /> <span class="small_label hw_shop_goback"> Back to gateway</span>

<br />
<br />

<div class="pane hw_gw_shop">
    <img src="modules/img/mygateway/{{ $partType }}.png" alt="Upgrade" />
    <span class="title">{{ strtoupper($partType) }} UPGRADE</span>
    <div class="hw_shop_list">
        <ul>
            @foreach()
                <li rel="{$v['id']}" class="hw_shop_list_item"><span style="float: left">${$v['price']}</span><span style="width: 100px; font-weight:bold;">{$v['name']}</span><span style="float: right;">{$v['value']} {$v['valueType']}</span></li>
            @endforeach
            {foreach from=$partlist key=k item=v}
            <li rel="{$v['id']}" class="hw_shop_list_item"><span style="float: left">${$v['price']}</span><span style="width: 100px; font-weight:bold;">{$v['name']}</span><span style="float: right;">{$v['value']} {$v['valueType']}</span></li>
            {/foreach}
        </ul>
    </div>
</div>

<script type="text/javascript" src="{$modulePath}js/shop.js"></script>