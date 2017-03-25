<div id="register_window" class="dialog_window" title="Register new account">
    <center>
        <h1 class="title">Register new account</h1>
    </center>
    <div class="pane">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('username') ? ' has-input-error' : '' }}">
                <label for="username" class="col-md-4 control-label">Username</label>

                <div>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-input-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-input-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('invite') ? ' has-input-error' : '' }}">
                <label for="invite" class="col-md-4 control-label">Invite code</label>

                <div>
                    <input id="invite" type="text" maxlength="16" class="form-control" name="invite" value="{{ old('invite') }}" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>