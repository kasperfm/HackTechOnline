@extends('templates.www')

@section('extra-head')
    <link href="vfs/web/css/87_49_178_1.css" rel="stylesheet">
    <style>
        @import url(fonts/font-exo.css);
        @import url(fonts/font-sourcesanspro.css);
    </style>

    <script type="text/javascript" src="vfs/web/js/87_49_178_1-prefixfree.min.js"></script>
@endsection

@section('content')
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>GerMail</div>
    </div>
    <br />
    <div class="login">
        <input type="text" class="germail_login_username" placeholder="username" name="user"><br />
        <input type="password" class="germail_login_password" placeholder="password" name="password"><br />
        <input type="button" class="germail_login_btn" value="Login">
    </div>

@endsection
