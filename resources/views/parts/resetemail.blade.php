<div id="resetemail_window" class="dialog_window" title="Reset password">
    <div class="panel-body">
        @if (session('status'))
            <script>alert("{{ session('status') }}");</script>
        @endif

        <form role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' has-input-error' : '' }}" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>