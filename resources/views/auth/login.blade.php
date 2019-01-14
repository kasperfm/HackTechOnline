@extends('layouts.game')

@section('content')
    @include('parts.login')
@endsection

@section('extra-js')
    <script src="js/effects.js"></script>
    <script src="{{ mix('/js/login.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            if($(".login-error").length > 0){
                $(".title").html("ACCESS DENIED").css("color", "#F70F0F");
                setTimeout(function(){
                    $("#login_window").dialog("widget").effect("shake", { times: 3 }, 800);
                }, 1400);
            }
        });
    </script>

    @if(Session::has('login_message'))
        <script type="text/javascript">
        alert("{{ Session::get('login_message') }}");
        </script>

        @php(Session::forget('login_message'))
    @endif
@endsection