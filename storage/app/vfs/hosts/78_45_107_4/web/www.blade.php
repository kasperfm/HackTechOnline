@extends('templates.www')

@section('content')
    <link href="vfs/web/css/78_45_107_4.css" rel="stylesheet">

    <div>
        <h1 class="default-title text-purple">ShareMyPwd.info</h1>
        <h1 class="default-title text-red italic-font">&lt;-- Easy, safe and plain simple --&gt;</h1>
    </div>

    <div class="pane-margin">
        <center>
            <table border="0">
                <tr>
                    <td><h1 class="text" style="text-align: right;">Access token</h1></td>
                    <td><img src="vfs/web/img/78_45_107_4-lightning_icon.png" alt="Token" /></td>
                    <td><input type="text" class="token-input" name="token-input" /></td>
                </tr>

                <tr>
                    <td><h1 class="text" style="text-align: right;">Password</h1></td>
                    <td><img src="vfs/web/img/78_45_107_4-lock_icon.png" alt="Password" /></td>
                    <td><input type="text" class="password-input" name="password-input" /></td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td><input class="default-title submit-pwd-btn" type="button" name="submit-pwd-btn" value="&lt; Share &gt;" /></td>
                </tr>
            </table>
        </center>
    </div>

    <script>
        $(document).ready(function() {
            $(".submit-pwd-btn").bind("click", function(){
                var token_input = $(".token-input").val();
                var password_input = $(".password-input").val();

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    url: '/game/web/78_45_107_4/ajax/submit',
                    data: {
                        token: token_input,
                        password: password_input
                    },
                    success: function(response) {
                        if(response.answer === true) {
                            // magic
                        }
                    }
                });
            });
        });
    </script>
@endsection
