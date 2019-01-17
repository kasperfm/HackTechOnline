<div id="register_window" class="dialog_window" title="Register new account">
    <div style="text-align: center;">
        <h1 class="title">Register new account</h1>
    </div>
    <div class="pane" style="text-align: center;">
        <form class="form-horizontal" name="register-form" id="register-form" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' has-input-error' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' has-input-error' : '' }}" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' has-input-error' : '' }}" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <label for="invite" class="col-md-4 control-label">Invite code</label>

                <div>
                    <input id="invite" type="text" maxlength="16" class="form-control{{ $errors->has('invite') ? ' has-input-error' : '' }}" name="invite" value="{{ old('invite') }}">
                </div>
            </div>

            <div class="text-center">
                <div class="g-recaptcha" data-theme="dark" data-sitekey="6LcuFN8SAAAAAJZ7Uv3BOhneF6IDCQoNGl0RIZdo"></div>
            </div>
            
            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary register-btn">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
