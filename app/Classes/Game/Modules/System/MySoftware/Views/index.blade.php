<ul>
    @foreach($softwareList as $software)
        @if($software['installed'] == 1)
            <li rel="{{ $software['id'] }}" app-state="installed" class="toggle-install-state text-green">{{ $software['name'] }} v{{  number_format($software['version'], 1, '.', '') }}</li>
        @else
            <li rel="{{ $software['id'] }}" app-state="removed" class="toggle-install-state text-red">{{ $software['name'] }} v{{  number_format($software['version'], 1, '.', '') }}</li>
        @endif
    @endforeach
</ul>

<script type="text/javascript" src="{{ $jsPath }}mysoftware.js"></script>
