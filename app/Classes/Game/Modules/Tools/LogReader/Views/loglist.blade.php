<ul class="log-reader-list">
    @if(!$logs)
        <li>No logs found</li>
    @else
        @if($logs->count() == 0)
            <li>No logs found</li>
        @else
            @foreach($logs as $logEntry)
                <li class="tooltip"><span class="tooltiptext">{{ $logEntry->created_at }}</span>{{ $logEntry->description }}</li>
            @endforeach
        @endif
    @endif
</ul>