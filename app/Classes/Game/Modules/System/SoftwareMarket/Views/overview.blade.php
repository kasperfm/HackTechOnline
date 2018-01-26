<ul>
    @if(empty($softwareList))
        <li>No software available for purchase...</li>
    @endif
    @foreach($softwareList as $software)
                <li rel="{{$software->app_name}}">
                    {{ $software->app_name }} v@php echo number_format($software->version, 1, '.', '') @endphp<br />Price: ${{$software->data->price}}
                    <button class="btn_small info-app" rel="{{$software->version}}">INFO</button>
                </li>
    @endforeach
</ul>