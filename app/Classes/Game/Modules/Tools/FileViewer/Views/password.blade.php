<label for="password_prompt">Password:</label>
<br>
<input type="text" name="password_prompt" id="password_prompt" maxlength="64" />
<button name="connect_to_server_btn" id="connect_to_server_btn" class="btn_small">Login</button>

<script>
    $('#connect_to_server_btn').click(function () {
        fileViewerHostPassword = $("#password_prompt").val();
        $(".fileinspector_filetree").remove();
        $("#fileinspector_left").append('<div class="fileinspector_filetree"></div>');
        initFileTree();
        $('#password_prompt').val('');
        $('#server_prompt_password_window').dialog("close");
    });
</script>