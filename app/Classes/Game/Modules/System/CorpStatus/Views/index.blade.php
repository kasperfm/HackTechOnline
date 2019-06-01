<ul style="padding-bottom: 40px;">
    <li>
        <strong>{{ currentPlayer()->corporation && currentPlayer()->corporation->owner->id == currentPlayer()->userID ? 'Owner' : 'Member' }} of:</strong> <span class="highlight">{{ currentPlayer()->corporation ? currentPlayer()->corporation->name : 'N/A'}}</span>
    </li>
</ul>

@if(currentPlayer()->corporation)
    @if(currentPlayer()->corporation->owner->id == currentPlayer()->userID)
        <button class="btn" id="manage_corporation_btn" tabindex="-1" style="width: 100%;">Manage</button>
        <span style="position: absolute; padding-top: 35px;">You are the owner of this corp! You have to assign a new owner before you can leave it.</span>

        <div id="manage_corporation_window" class="dialog_window" title="Manage corporation">
            @include('Modules::System.CorpStatus.Views.manage')
        </div>
    @else
        <button class="btn" id="leave_corporation_btn" tabindex="-1" style="width: 100%; color: #fb2e2e;">Leave corporation</button>
    @endif
@else
    <div id="new_corporation_window" class="dialog_window" title="Create new corporation">
        @include('Modules::System.CorpStatus.Views.newcorp')
    </div>

    <button class="btn" id="new_corporation" tabindex="-1" style="width: 100%;">Create new</button>
    <div style="padding-bottom: 15px;"></div>
    <div style="text-align: center">or</div>
    <div style="padding-bottom: 15px;"></div>
    <label for="invitekey">Invite key:</label> <input type="text" tabindex="-1" maxlength="32" size="24" id="invitekey" name="invitekey" />     <button id="join_corporation_btn" class="btn" tabindex="-1" style="width: 100px;">Join</button>
@endif

<link rel="stylesheet" href="{{ $cssPath }}corpstatus.css" type="text/css" />
<script type="text/javascript" src="{{ $jsPath }}corpstatus.js?v={{ useJSCache() }}"></script>