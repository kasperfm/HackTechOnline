@extends(backpack_view('blank'))

@php
    $breadcrumbs = [
        trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
        'Game content' => false,
        'New server' => false,
    ];
@endphp

@section('header')
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1>New server</h1>
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

        {{-- NEW SERVER SUBMISSION FORM --}}
        <div class="col-lg-8">
            <form class="form" action="{{ route('content.servercreator.store') }}" method="post">

                {!! csrf_field() !!}

                <div class="card padding-10">

                    <div class="card-header">
                        Server details
                    </div>

                    <div class="card-body bold-labels">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="ip" class="required">IP</label>
                                <input required class="form-control" type="text" name="ip" id="ip" value="{{ old('ip') ? old('ip') : '' }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="domain" class="required">Domain</label>
                                <input class="form-control" type="text" name="domain" id="domain" value="{{ old('domain') ? old('domain') : '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="rootpassword" class="required">Root password</label>
                                <input class="form-control" type="text" name="rootpassword" id="rootpassword" value="{{ old('rootpassword') ? old('rootpassword') : '' }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="owner" class="required">Server owner</label>
                                <input class="form-control" type="text" name="owner" id="owner" value="{{ old('owner') ? old('owner') : '' }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="required">Services / Ports</label>
                                <br>
                                <div class="btn btn-primary" id="new-service-btn">Add new</div>

                                <div id="services">
                                    <div class="new-service new-service-orig row" style="display: none;">
                                        <div class="col-md-2 form-group">
                                            <label>Type</label>
                                            <select class="form-control service-select" name="services[]">
                                                @foreach($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 form-group">
                                            <label>Port number</label><input class="form-control port-input" type="number" name="ports[]" value="80">
                                        </div>

                                        <hr>
                                    </div>
                                </div>
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
        var numOfServices = 0;
        $("#new-service-btn").click(function() {
            var serviceItem = $(".new-service-orig").clone().appendTo("#services").css('display', 'block').removeClass('new-service-orig').addClass('port-item-' + numOfServices);
            serviceItem.find('.service-select').attr('rel', numOfServices);
            serviceItem.find('.port-input').addClass('port-input-' + numOfServices);

            numOfServices++;
        });

        $(document).on('change', '.service-select', function(e) {
            var serviceItemID = e.target.getAttribute('rel');

            var ele = $('.port-item-' + serviceItemID).find('select').val();

            $.ajax({
                type: 'get',
                dataType: 'json',
                cache: false,
                url: '{{ route('content.servercreator.ajax.getport') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    service: ele
                },
                success: function (response) {
                    $('.port-input-' + serviceItemID).val(response);
                }
            });


        });
    </script>
@endsection
