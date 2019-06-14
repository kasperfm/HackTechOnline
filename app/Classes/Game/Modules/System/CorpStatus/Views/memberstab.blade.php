<div class="pane" style="max-height: 155px; height: 155px;">
    <ul>
        @foreach($corpMembers as $member)
            @if($member->id == currentPlayer()->userID)
                <li class="clickable" onclick="corpManagerLoadMemberPage({{ $member->id }})">[OWNER] {{ $member->username }}</li>
            @else
                <li class="clickable" onclick="corpManagerLoadMemberPage({{ $member->id }})">{{ $member->username }}</li>
            @endif
        @endforeach
    </ul>
</div>