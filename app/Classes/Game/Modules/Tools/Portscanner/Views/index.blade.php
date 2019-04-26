<script type="text/javascript" src="{{ $jsPath }}portscanner.js?v={{ useJSCache() }}"></script>
<form class="portscan-form form_small" id="portscan-form">
    <center>
        <input class="input_small-nofont noEnterSubmit scan-address" type="text" name="scan-address" id="scan-address" maxlength="100" width="45" />
        <input class="btn_small" type="button" id="scan-submit" name="scan-submit" value="Scan" />
    </center>
</form>

<div style="padding-top: 15px;">
    <ul id="portscan-results">
        <li>No scan results...</li>
    </ul>
</div>