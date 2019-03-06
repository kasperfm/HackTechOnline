<script type="text/javascript" src="{{ $jsPath }}iprenewer.js?v={{ md5(time()) }}"></script>
<form class="iprenewer-form form_small" id="iprenewer-form">
    <center>
        <p>Click the button to renew the IP address of your gateway.</p>
        <br>
        <p><small>You can only renew your IP once every 3 hours!</small></p>
        <br>
        <input class="btn_small" type="button" id="renew-submit" name="renew-submit" value="Renew" />
    </center>
</form>