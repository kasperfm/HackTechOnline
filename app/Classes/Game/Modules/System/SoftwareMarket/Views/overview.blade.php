<ul>
    @foreach($softwareList as $software)
        <li rel="{{$software->app_name}}">{{ $software->app_name }} v@php echo number_format($software->version, 1, '.', '') @endphp<br />Price: ${{$software->data->price}}<br /><span class="info-app" rel="{{$software->version}}">INFO</span><span class="buy-app" rel="{{$software->id}}">BUY</span></li>
    @endforeach
</ul>