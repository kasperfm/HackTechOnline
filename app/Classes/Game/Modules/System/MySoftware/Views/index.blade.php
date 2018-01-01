<ul>
    @foreach($softwareList as $software)
        @if($software->installed == 1)
            <li rel="{{ $software->application()->id }}" class="remove-software text-green">{{ $software->application()->app_name }}</li>
        @else
            <li rel="{{ $software->application()->id }}" class="install-software text-red">{{ $software->application()->app_name }}</li>
        @endif
    @endforeach
</ul>

<script type="text/javascript" src="{{ $jsPath }}mysoftware.js"></script>
