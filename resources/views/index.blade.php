@extends('layouts.game')

@section('topbar')
    @include('parts.topbar')
@endsection

@section('content')
    @include('modules.demo.welcome.views.index')
@endsection

@section('footer')
    @include('parts.footer')
@endsection

@section('extra-js')
<script src="/js/init.js?v={{ md5(time()) }}"></script>
@endsection
