<div class="pane">
    <form class="resetaccount-form" id="resetaccount-form">
        <p><strong>This will reset your HTO account!</strong><br>All hardware and software purchases will be deleted, you will lose all downloaded files, and completed missions will be reset too.</p>
        <div style="padding-top: 20px;">
            <label for="accept-check">Are you sure?</label>
            <input type="checkbox" name="accept-check" id="accept-check" value="accept" />
        </div>

        <div style="margin: 0 auto; width: 200px; padding-top: 10px;">
            <input type="button" value="Reset HTO Account" id="resetaccount-submit" />
        </div>
    </form>
</div>

<script type="text/javascript">
    var sent = false;
    $(document).ready(function() {
        $("#resetaccount-submit").click(function(){
            if(sent === false &&  $('#accept-check').is(':checked')){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    url: '/game/module/AccountReset/ajax/submit',
                    data: {
                        _token: window.Laravel.csrfToken,
                        accept: true
                    },
                    success: function(response){
                        sent = true;
                        window.location.href = "{{ route('game-logout') }}";
                    }
                });
                return false;
            }
        });
    });
</script>