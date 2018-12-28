<table border="0" cellspacing="20" cellpadding="50">
    <tr class="hw_item" rel="cpu">
        <td><img src="modules/img/mygateway/cpu.png" alt="CPU" /></td> <td><h1 class="text-pink hw_cpu">CPU</h1><h3>{{ $currentCPU->hardwareData['name'] }}</h3><h3 class="val_cpu">[ {{ $currentCPU->hardwareData['value'] }} MHz ]</h3></td>
    </tr>
    <tr class="hw_item" rel="ram">
        <td><img src="modules/img/mygateway/ram.png" alt="RAM" /></td> <td><h1 class="text-pink hw_ram">RAM</h1><h3>{{ $currentRAM->hardwareData['name'] }}</h3><h3 class="val_ram">[ {{ $currentRAM->hardwareData['value'] }} MB ]</h3></td>
    </tr>
    <tr class="hw_item" rel="hdd">
        <td><img src="modules/img/mygateway/hdd.png" alt="HDD" /></td> <td><h1 class="text-pink hw_hdd">Storage</h1><h3>{{ $currentHDD->hardwareData['name'] }}</h3><h3 class="val_hdd">[ {{ $currentHDD->hardwareData['value'] }} MB ]</h3></td>
    </tr>
    <tr class="hw_item" rel="net">
        <td><img src="modules/img/mygateway/net.png" alt="NET" /></td> <td><h1 class="text-pink hw_net">Internet</h1><h3>{{ $currentNET->hardwareData['name'] }}</h3><h3 class="val_net">[ {{ $currentNET->hardwareData['value'] }} Mbit/s ]</h3></td>
    </tr>
</table>