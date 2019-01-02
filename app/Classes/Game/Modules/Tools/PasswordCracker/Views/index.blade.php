<script type="text/javascript" src="js/jquery.base64.js"></script>
<script type="text/javascript" src="{{ $jsPath }}passwordcracker.js?v={{ md5(time()) }}"></script>
<form class="passwd_cracker_form" id="passwd_cracker_form" onsubmit="return false;">
    <table cellspacing="5px">
        <tr>
            <td><label class="small_label" for="password">Encrypted password:</label></td>
        </tr>
        <tr>
            <td>
                <span style="display: none;" class="decrypt-text"></span><input style="width: 250px;" class="password_field" maxlength="250" size="30" type="text" name="password" id="password">
            </td>
        </tr>
        <tr>
            <td><input class="btn crack_btn" type="submit" id="crack_passwd_btn" name="crack_passwd_btn" value="Crack"></td>
        </tr>
    </table>
</form>
