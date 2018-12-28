<ul>
    @foreach($softwareList as $software)
        @if($software['installed'] == 1)
            <li rel="{{ $software['id'] }}" app-state="installed" class="toggle-install-state text-green">{{ $software['name'] }} v{{  number_format($software['version'], 1, '.', '') }}</li>
        @else
            <li rel="{{ $software['id'] }}" app-state="removed" class="toggle-install-state text-red">
                {{ $software['name'] }} v{{  number_format($software['version'], 1, '.', '') }}
                <br>
                File Size: {{ $software['hdd_req'] }} MB
            </li>
        @endif
    @endforeach
</ul>

<script type="text/javascript" src="{{ $jsPath }}mysoftware.js?v={{ md5(time()) }}"></script>
