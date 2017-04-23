@extends('layouts.game')

@section('extra-head')
<script src='https://www.google.com/recaptcha/api.js'></script>
<style>
    #register_window input{
        width: 95%;
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
    @include('parts.register')
@endsection

@section('extra-js')
    <script src="{{ mix('/js/register.js') }}"></script>
@endsection