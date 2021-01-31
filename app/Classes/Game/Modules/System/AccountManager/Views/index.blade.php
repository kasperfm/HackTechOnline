<div class="pane">
    <form class="accountmanager" id="accountmanager-delete-form">
        <p><strong>Delete your game account !</strong><br>
            Your game account will be deleted, and all your progress, servers, files and everything else will be gone forever.
        </p>
        <div style="padding-top: 20px;">
            <label for="password-check">Account password</label>
            <input type="password" name="password-check" id="password-check" />
        </div>
        <div style="padding-top: 20px;">
            <label for="accept-check">Are you sure?</label>
            <input type="checkbox" name="accept-check" id="accept-check" value="accept" />
        </div>

        <div style="margin: 0 auto; width: 200px; padding-top: 10px;">
            <input type="button" value="Delete HTO Account" id="deleteaccount-submit" />
        </div>
    </form>
</div>

<script type="text/javascript">
    var sent = false;
    $(document).ready(function() {
        $("#deleteaccount-submit").click(function(e){
            if(sent === false &&  $('#accept-check').is(':checked')){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    async: false,
                    url: '/game/module/AccountManager/ajax/deleteaccount',
                    data: {
                        _token: window.Laravel.csrfToken,
                        accept: true,
                        password: $('#password-check').val()
                    },
                    success: function(response){
                        if(response.result) {
                            sent = true;
                            window.location.href = "{{ route('game-logout') }}";
                        }
                    }
                });
            }
        });
    });
</script>