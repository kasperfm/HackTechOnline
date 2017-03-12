@extends('layouts.game')

@section('content')
    @include('parts.register')
@endsection

@section('extra-js')
    <script src="{{ mix('/js/register.js') }}"></script>
@endsection