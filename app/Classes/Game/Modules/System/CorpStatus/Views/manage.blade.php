<div id="corp-tabs">
    <ul>
        <li><a href="#corp-members-tab" class="corp-members-linkbtn">Members</a></li>
        <li><a href="#corp-settings-tab">Settings</a></li>
    </ul>

    <div id="corp-members-tab">
        <p>Loading member management...</p>
    </div>

    <div id="corp-settings-tab">
        <div class="pane" style="max-height: 245px; height: 235px;">
            <ul>
                <li><strong>Corporation name:</strong> <span class="highlight">{{ currentPlayer()->corporation->name }}</span></li>
                <li><strong>Invite key:</strong> <span class="highlight">{{ currentPlayer()->corporation->inviteKey }}</span></li>
            </ul>
            <span>Description:</span>
            <br>
            <textarea name="corp_edit_description" id="corp_edit_description" style="width: 405px; height: 80px;">{{ currentPlayer()->corporation->description }}</textarea>
            <br>
            <button class="btn edit_corp_btn">Save</button>
        </div>
    </div>
</div>