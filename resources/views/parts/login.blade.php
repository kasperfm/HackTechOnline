<div id="login_window" class="dialog_window" title="System Authentication">
    <center>
        <canvas id="login-logo-canvas"></canvas>
        <h1 class="title status">PLEASE LOGIN TO USE THE SYSTEM</h1>
    </center>

    <div class="pane">
        <form class="form-horizontal login-form {{ $errors->has('email') || $errors->has('password') ? ' login-error' : '' }}" id="login-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <table>
                <tr>
                    <td>
                        <label>E-MAIL</label>
                    </td>
                    <td>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>PASSWORD</label>
                    </td>
                    <td>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" style="margin-top: 15px;">
                                Login
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="remember">Remember Me</label> <input type="checkbox" class="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        </div>

                        <div class="form-group">
                            <a class="btn-link" style="color: white !important;" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>

                        <div class="form-group">
                            <a style="color: #FF0091 !important;" href="{{ route('register') }}">Register new game account</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>