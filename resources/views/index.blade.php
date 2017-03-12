@extends('layouts.game')

@section('topbar')
    @include('parts.topbar')
@endsection

@section('content')
    @include('modules.demo.module')
@endsection

@section('footer')
    @include('parts.footer')
@endsection

@section('extra-js')
    <script src="{{ mix('/js/init.js') }}"></script>
@endsection
