<link rel="stylesheet" href="{{ $cssPath }}mailbox.css" type="text/css" />

<div id="email-tabs">
    <ul>
        <li><a href="#email-list-tab" class="email-inbox-linkbtn">Inbox</a></li>
        <li><a href="#email-newmail-tab">New mail</a></li>
    </ul>

    <div id="email-list-tab">
        <p>Loading inbox...</p>
    </div>

    <div id="email-newmail-tab">
        <form id="sendmail-form" method="post">

            <table border="0">
                <tr>
                    <td><label for="userto">Recipient:</label></td>
                    <td><input type="text" tabindex="1" name="userto" id="userto" maxlength="25" size="25" /></td>
                    <td><input type="submit" tabindex="4" value="Send" /></td>
                </tr>

                <tr>
                    <td><label for="mailsubject">Subject:</label></td>
                    <td><input type="text" tabindex="2" name="mailsubject" id="mailsubject" maxlength="30" size="30" /></td>
                    <td></td>
                </tr>
            </table>

            <textarea name="mailcontent" tabindex="3" id="mailcontent" rows="6" maxlength="512"></textarea>

        </form>
    </div>
</div>

<div style="display:none;" id="email-view-dialog" class="email-view-dialog" title="Message">
    <p class="email-view-dialog-msgdate"></p>
    <p class="email-view-dialog-msgcontent"></p>
</div>

<script type="text/javascript" src="{{ $jsPath }}mailbox.js?v={{ md5(time()) }}"></script>
