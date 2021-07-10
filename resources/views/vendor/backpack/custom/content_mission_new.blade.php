@extends(backpack_view('blank'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        'Game content' => false,
        'New mission' => false,
    ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>New mission</h1>
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

        {{-- NEW MISSION SUBMISSION FORM --}}
        <div class="col-lg-8">
            <form class="form" action="{{ route('content.missioncreator.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        Mission details
                    </div>

                    <div class="card-body bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="title" class="required">Title</label>
                                <input required class="form-control" type="text" name="title" id="title" value="{{ old('title') ? old('title') : '' }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="type" class="required">Objective type</label>
                                <select required class="form-control" name="type" id="type">
                                    <option value="visit">Visit website</option>
                                    <option value="get">Download file</option>
                                    <option value="put">Upload file</option>
                                    <option value="renewip">Renew IP</option>
                                    <option value="submit">Submit data</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="host" class="required">Corporation</label>
                                <select required class="form-control" name="type" id="type">
                                    @foreach(\App\Models\Corporation::whereNull('owner_user_id')->orderBy('name')->get() as $corp)
                                        <option value="{{ $corp->id }}">{{ $corp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="complete_msg" class="required">Complete message</label>
                                <input required class="form-control" type="text" name="complete_msg" id="complete_msg" value="{{ old('complete_msg') ? old('complete_msg') : '' }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="req_trust" class="required">Required trust points</label>
                                <input required class="form-control" type="number" name="req_trust" id="req_trust" value="{{ old('req_trust') ? old('req_trust') : '0' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="description" class="required">Mission description</label>
                                <textarea required rows="5" class="form-control" name="description" id="description">{{ old('description') ? old('description') : '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-save"></i> {{ trans('backpack::base.save') }}</button>
                        <a href="{{ backpack_url() }}" class="btn">{{ trans('backpack::base.cancel') }}</a>
                    </div>
                </div>

            </form>
        </div>

    </div>

    <script>

    </script>
@endsection
