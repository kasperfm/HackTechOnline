<link rel="stylesheet" href="{{ $cssPath }}mygateway.css" type="text/css" />

<table border="0" cellspacing="20" cellpadding="50">
    <tr class="hw_item" rel="cpu">
        <td><img src="modules/img/mygateway/cpu.png" alt="CPU" /></td> <td><h1 class="text-pink hw_cpu">CPU</h1><h3>{{ $currentCPU->part_name }}</h3><h3 class="val_cpu">[ {{ $currentCPU->value }} MHz ]</h3></td>
    </tr>
    <tr class="hw_item" rel="ram">
        <td><img src="modules/img/mygateway/ram.png" alt="RAM" /></td> <td><h1 class="text-pink hw_ram">RAM</h1><h3>{{ $currentRAM->part_name }}</h3><h3 class="val_ram">[ {{ $currentRAM->value }} MB ]</h3></td>
    </tr>
    <tr class="hw_item" rel="hdd">
        <td><img src="modules/img/mygateway/hdd.png" alt="HDD" /></td> <td><h1 class="text-pink hw_hdd">Harddrive</h1><h3>{{ $currentHDD->part_name }}</h3><h3 class="val_hdd">[ {{ $currentHDD->value }} GB ]</h3></td>
    </tr>
    <tr class="hw_item" rel="net">
        <td><img src="modules/img/mygateway/net.png" alt="NET" /></td> <td><h1 class="text-pink hw_net">Internet</h1><h3>{{ $currentNET->part_name }}</h3><h3 class="val_net">[ {{ $currentNET->value }} Mbit/s ]</h3></td>
    </tr>
</table>

<script type="text/javascript" src="{{ $jsPath }}mygateway.js"></script>