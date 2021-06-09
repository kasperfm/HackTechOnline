@extends(backpack_view('blank'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        'Game content' => false,
        'New file' => false,
    ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>New file</h1>
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

        {{-- NEW FILE SUBMISSION FORM --}}
        <div class="col-lg-8">
            <form class="form" action="{{ route('content.filecreator.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        File details
                    </div>

                    <div class="card-body bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="filename" class="required">Filename</label>
                                <input required class="form-control" type="text" name="filename" id="filename" value="{{ old('filename') ? old('filename') : '' }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="type" class="required">Type</label>
                                <select required class="form-control" name="type" id="type">
                                    <option value="txt">Text</option>
                                    <option value="bin">Binary</option>
                                    <option value="image">Image</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="host" class="required">Host IP</label>
                                <input required class="form-control" type="text" name="host" id="host" value="{{ old('host') ? old('host') : '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="password" class="required">Password (optional)</label>
                                <input class="form-control" type="text" name="password" id="password" value="{{ old('password') ? old('password') : '' }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="size" class="required">File size in MB</label>
                                <input required class="form-control" type="number" name="size" id="size" value="{{ old('size') ? old('size') : '1' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="content" class="required">Content editor</label>
                                <textarea required rows="15" class="form-control" name="content" id="content">{{ old('content') ? old('content') : '' }}</textarea>
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
