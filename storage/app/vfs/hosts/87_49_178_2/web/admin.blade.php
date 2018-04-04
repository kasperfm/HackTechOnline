@php
    session_start();
    if(empty($_SESSION['ingame_www']['admin.germail.com_authed'])){
        die('Access denied!');
    }

@endphp

@extends('templates.www')

@section('extra-head')
    <link href="vfs/web/css/87_49_178_2.css" rel="stylesheet">
    <style>
        @import url(fonts/font-exo.css);
        @import url(fonts/font-sourcesanspro.css);
    </style>

    <script type="text/javascript" src="vfs/web/js/87_49_178_2-prefixfree.min.js"></script>
    <script type="text/javascript" src="vfs/web/js/87_49_178_2-adm_page.js"></script>
@endsection

@section('content')
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>Admin</div>
    </div>
    <br />
    <div class="login">
        <input class="download_config_btn" rel="xxx" type="button" value="Download config file" />
        <input class="restricted_btn" type="button" value="Upload new config" />
        <input class="restricted_btn" type="button" value="Restart server" />
    </div>

@endsection
