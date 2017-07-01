@extends('layouts.game')

@section('content')
    @include('parts.login')
@endsection

@section('extra-js')
    <script src="js/effects.js"></script>
    <script src="{{ mix('/js/login.js') }}"></script>
@endsection