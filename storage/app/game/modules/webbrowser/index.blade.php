<script>
    var csrfToken = '{{ csrf_token() }}';
</script>
<script type="text/javascript" src="{{ $jsPath }}webbrowser.js"></script>
<link rel="stylesheet" href="{{ $cssPath }}webbrowser.css" type="text/css" />

<div class="www-navigation">
    <form class="navigation-form form_small" id="navigation-form">
        <center><input class="input_small-nofont noEnterSubmit" type="text" name="www-address" id="www-address" maxlength="100"> <input class="btn_small" type="button" id="www-submit" name="www-submit" value="Go >>"></center>
    </form>
</div>

<div id="webbrowser-wrapper">
    <div class="webbrowser-content pane">
    </div>
</div>
