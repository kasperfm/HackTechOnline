@extends('layouts.game')

@section('extra-head')
    <style>
        #register_window input{
            width: 94%;
        }

        #register_window button{
            margin-top: 5px;
        }

        .g-recaptcha {
            display: inline-block;
        }

        .text-center {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div id="register_window" class="dialog_window" title="Register using Facebook">
        <div style="text-align: center;">
            <h1 class="title">Register using Facebook</h1>
        </div>
        <div class="pane" style="text-align: center;">
            <form class="form-horizontal" name="register-form" id="register-form" role="form" method="POST" action="{{ route('facebook-register') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="invite" class="col-md-4 control-label">Invite code</label>

                    <div>
                        <input id="invite" required type="text" maxlength="16" class="form-control{{ $errors->has('invite') ? ' has-input-error' : '' }}" name="invite" value="{{ old('invite') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary register-btn">
                            Register with Facebook
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#register_window').dialog({
                width: 450,
                height: 400,
                autoOpen: true,
                hide: {duration: 225},
                resizable: false,
                closeOnEscape: false,
                open: function(){
                    $(".ui-dialog-titlebar-close").hide();
                    $(".ui-dialog-titlebar-min").hide();
                },
                close: function (event, ui) {
                    $(this).remove();
                }
            });
            $('#register_window').dialog("widget").draggable("option", "containment", "#window_wrapper");

            $('#register-form').on("submit", function (e) {
                $('.register-btn').prop("disabled", true);
            });
        });

    </script>
@endsection
