@extends('layouts.game')

@section('extra-head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    @include('parts.register')
@endsection

@section('extra-js')
    <script src="{{ mix('/js/register.js') }}"></script>
@endsection