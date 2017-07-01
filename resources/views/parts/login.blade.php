<div id="login_window" class="dialog_window" title="System Authentication">
    <center>
        <canvas id="login-logo-canvas"></canvas>
        <h1 class="title">PLEASE LOGIN TO USE THE SYSTEM</h1>
    </center>

    <div class="pane">
        <form class="form-horizontal login-form" id="login-form" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <table>
                <tr>
                    <td>
                        <label>E-MAIL</label>
                    </td>
                    <td>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' has-input-error' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>PASSWORD</label>
                    </td>
                    <td>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' has-input-error' : '' }}" name="password" required>
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
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="remember">Remember Me</label> <input type="checkbox" class="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        </div>

                        <div class="form-group">
                            <a class="btn-link" style="color: white !important;" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>