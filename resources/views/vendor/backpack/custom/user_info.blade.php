@extends(backpack_view('blank'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        'Users' => false,
        'Show' => false,
    ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>User details</h1>
        </div>
    </section>
@endsection

@section('content')
    <div class="row">
        @if (session('success'))
            <div class="col-lg-8">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if ($errors->count())
            <div class="col-lg-8">
                <div class="alert alert-danger">
                    <ul class="mb-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- USER DETAILS PAGE --}}
        <div class="col-lg-8">
            <div class="card padding-10">

                <div class="card-header">
                    <h2>{{ $user->username }}</h2>
                </div>

                <div class="card-body bold-labels">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Account</h4>
                            <span><strong>Register date:</strong> {{ $user->model->created_at->toFormattedDateString() }}</span>
                            <br>
                            <span><strong>Account verified:</strong> {{ $user->model->verified ? 'Yes' : 'No' }}</span>
                            <br>
                            <span><strong>User type:</strong> {{ $user->userRole }}</span>
                        </div>

                        <div class="col-md-6">
                            <h4>In-Game</h4>
                            <span><strong>Credits:</strong> ${{ $user->economy->getBalance() }}</span>
                            <br>
                            <span><strong>Corporation:</strong>
                                @if($user->corporation)
                                    <a href="{{ backpack_url('corporation', $user->corporation->corpID) }}/show">{{ $user->corporation->name }}</a>
                                @else
                                    N/A
                                @endif
                            </span>
                            <br>
                            <span><strong>Gateway IP:</strong> {{ $user->gateway->ipAddress }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-lg-8">
                <div class="card padding-10">

                    <div class="card-header">
                        <h2>Logs</h2>
                    </div>

                    <div class="card-body bold-labels">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Recent Logins</h4>
                                <ul>
                                @foreach($user->model->logins()->orderBy('last_date', 'desc')->take(10)->get() as $entry)
                                    <li>
                                        {{ $entry->last_date }} - {{ $entry->last_ip }}
                                    </li>
                                @endforeach
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h4>Activity</h4>
                                <ul>
                                    @foreach(\Spatie\Activitylog\Models\Activity::where('causer_id' , $user->userID)->orderBy('created_at', 'desc')->take(15)->get() as $entry)
                                        <li class="activity-entry-btn" rel="{{ $entry->id }}">
                                            {{$entry->description}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="col-lg-8">
            <div class="card padding-10">

                <div class="card-header">
                    <h2>Admin actions</h2>
                </div>

                <div class="card-body bold-labels">
                    <div class="row">
                        <div class="col-md-2">
                            <div id="reset-account-btn" class="btn btn-secondary admin-btn" rel="reset-account">Reset Account</div>
                        </div>

                        <div class="col-md-2">
                            <div id="renew-ip-btn" class="btn btn-secondary admin-btn" rel="renew-ip">Renew gateway IP</div>
                        </div>

                        <div class="col-md-2">
                            @if($user->model->verified)
                                <div id="deactivate-account-btn" class="btn btn-secondary admin-btn" rel="deactivate-account">Deactivate account</div>
                            @else
                                <div id="activate-account-btn" class="btn btn-secondary admin-btn" rel="activate-account">Activate account</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".activity-entry-btn").click(function () {
            var activity_id = $(this).attr('rel');

            $.ajax({
                type: 'post',
                dataType: 'json',
                cache: false,
                url: '{{ route('user.getlog') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    log_id: activity_id,
                },
                success: function (response) {
                    alert('Log: ' + response.log_name + '\n' + 'Data: ' + JSON.stringify(response.properties));
                }
            });
        });

        $(".admin-btn").click(function() {
            var call_admin_action = $(this).attr('rel');

            $.ajax({
                type: 'post',
                dataType: 'json',
                cache: false,
                url: '{{ route('user.actions') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: {{ $user->userID }},
                    admin_action: call_admin_action
                },
                success: function (response) {
                    document.location.reload();
                }
            });
        });
    </script>
@endsection
