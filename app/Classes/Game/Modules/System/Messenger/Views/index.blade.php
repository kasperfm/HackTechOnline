<link rel="stylesheet" href="{{ $cssPath }}messenger.css" type="text/css" />

<div id="contentWrap">
    <div id="users"></div>
    <div id="chatBox"><ul id="chat"></ul></div>
</div>

<form id="send-message">
    <input style="width: 65%; float: left;" id="message" />
    <input style="margin-left: 10px; width: 100px; float: right;" class="btn_small" type="submit" value="Send" />
</form>

<script type="text/javascript">
    var username = '{{ $username }}';
    var backendServer = 'https://{{ config('hacktech.messenger.host') }}:{{ $chatBackendPort }}';
</script>

<script type="text/javascript" src="/js/socket.io.slim.js"></script>
<script type="text/javascript" src="{{ $jsPath }}messenger.js?v={{ md5(time()) }}"></script>