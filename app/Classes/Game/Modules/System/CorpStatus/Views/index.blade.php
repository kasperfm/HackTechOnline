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
    <button class="btn" tabindex="-1" style="width: 100%;">Join corporation</button>
@endif

