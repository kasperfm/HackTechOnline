<ul style="padding-bottom: 40px;">
    <li>
        <strong>Member of:</strong> <span class="highlight">{{ currentPlayer()->corporation ? currentPlayer()->corporation->name : 'N/A'}}</span>
    </li>
</ul>

@if(currentPlayer()->corporation)
    <button class="btn" tabindex="-1" style="width: 100%; color: #fb2e2e;">Leave corporation</button>
@else
    <button class="btn" tabindex="-1" style="width: 100%;">Create new</button>
    <div style="padding-bottom: 15px;"></div>
    <div style="text-align: center">or</div>
    <div style="padding-bottom: 15px;"></div>
    <label for="invitekey">Invite key:</label> <input type="text" tabindex="-1" maxlength="32" size="24" id="invitekey" name="invitekey" />     <button class="btn" tabindex="-1" style="width: 100px;">Join</button>
@endif

