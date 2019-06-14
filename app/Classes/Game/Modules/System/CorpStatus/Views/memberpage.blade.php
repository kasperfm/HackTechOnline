<img class="corp_memberpage_goback clickable" alt="Back" src="img/back_small.png" /> <span class="small_label corp_memberpage_goback clickable"> Back to member list</span>
<br />
<br />
<hr>
<br />
<ul>
    <li>
        <strong>Username:</strong> <span class="highlight">{{ $memberInfo->username }}</span>
    </li>

    <li>
        <strong>Role:</strong>
        <span class="highlight">
            @if($corp->owner->id == $memberInfo->userID)
                Owner
            @else
                Member
            @endif
        </span>
    </li>

    <li>
        <strong>Last login:</strong> <span class="highlight">{{ App\Models\UserLogin::where('user_id', $memberInfo->userID)->orderBy('id', 'desc')->first() ? App\Models\UserLogin::where('user_id', $memberInfo->userID)->orderBy('id', 'desc')->first()->last_date->toFormattedDateString() : 'Never!' }}</span>
    </li>
</ul>
<br>
<center>
    @if($corp->owner->id!= $memberInfo->userID)
        <button class="clickable btn kick_corp_member_btn" onclick="corpManagerKickMember({{ $memberInfo->userID }})">Kick member</button>
        <button class="clickable btn promote_corp_member_btn" onclick="corpManagerPromoteToLeader({{ $memberInfo->userID }})">Promote to owner</button>
    @endif
</center>