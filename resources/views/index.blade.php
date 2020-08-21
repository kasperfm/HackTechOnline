@extends('layouts.game')

@section('topbar')
    @include('parts.topbar')
@endsection

@section('content')
    @include('Modules.Demo.Welcome.Views.index')
@endsection

@section('footer')
    @include('parts.footer')
@endsection

@section('extra-js')
<script src="/js/init.js?v={{ useJSCache() }}"></script>
<script type="text/javascript">
    $.getScript('/game/missions/dynamicjs');
</script>
@endsection
