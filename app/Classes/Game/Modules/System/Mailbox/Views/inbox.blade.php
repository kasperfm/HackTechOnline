<table id="email-list-table" border="0">
    <tr>
        <th style="width: 150px;">Received</th>
        <th style="width: 150px;">From</th>
        <th style="width: auto;">Subject</th>
        <th style="width: 46px;"></th>
    </tr>

    @if(count($messages) == 0)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @else
        @foreach($messages as $message)
            @if($message->status == 1)
                <tr style="font-style: italic;">
            @else
                <tr class="email-inbox-item">
            @endif
                    <td>{{$message->created_at}}</td>
                    @if($message->from_user_id <= 0)
                        <td>SYSTEM</td>
                    @else
                        <td>{{$message->fromUser->username}}</td>
                    @endif
                    <td rel="{{$message->id}}">{{$message->subject}}</td>

                    @if($message->from_user_id <= 0)
                        <td><img class="email-reply-btn" rel="0" src="img/icon-reply.png" alt="Reply with new message" width="18px" height="18px" /> </td><td><img class="email-delete-btn" rel="{{$message->id}}" src="img/icon-delete.png" alt="Delete message" width="18px" height="18px" /></td>
                    @else
                        <td><img class="email-reply-btn" rel="{{$message->id}}" src="img/icon-reply.png" alt="Reply with new message" width="18px" height="18px" /></td><td><img class="email-delete-btn" rel="{{$message->id}}" src="img/icon-delete.png" alt="Delete message" width="18px" height="18px" /></td>
                    @endif

                </tr>
        @endforeach
    @endif
</table>