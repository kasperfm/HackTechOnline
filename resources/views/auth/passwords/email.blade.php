@extends('layouts.game')

@section('content')
    @include('parts.resetemail')
@endsection

@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#resetemail_window').dialog({
                width: 300,
                height: 260,
                autoOpen : true,
                resizable: false,
                closeOnEscape: false,
                open: function(){
                    $(".ui-dialog-titlebar-close").hide();
                    $(".ui-dialog-titlebar-min").hide();
                },
                position: {my: "center", at: "center", of: $("body"),within: $("body") }
            });

            $(".ui-dialog-titlebar-min").hide();
        });
    </script>
@endsection
