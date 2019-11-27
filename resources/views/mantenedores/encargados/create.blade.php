@extends('layouts.app')

@section('content')

    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-6 center order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('New Encargado') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('encargados.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Encargado Information') }}</h6>

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="nombre" id="input-name" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" required autofocus>

                                    @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div id="rut_container" class="form-group{{ $errors->has('rut') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-rut">{{ __('Rut') }}</label>
                                    <input type="text" name="rut" id="input-rut" class="form-control {{ $errors->has('rut') ? ' is-invalid' : '' }}" placeholder="{{ __('Rut') }}" required autofocus>

                                    @if ($errors->has('rut'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rut') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')

    <script src="{{asset('js/jquery.rut.js')}}"></script>
    <script>
        $("#input-rut").rut().on('rutInvalido', function (e) {
            var element = $("#input-rut")[0];
            $("#rut_container").addClass('has-danger');
            $("#input-rut").addClass('is-invalid');

            console.log('Invalid');
            element.setCustomValidity('Rut Invalido');
        });

        $("#input-rut").rut().on('rutValido', function (e, rut, dv) {
            var element = $("#input-rut")[0];
            $("#rut_container").removeClass('has-danger');
            $("#input-rut").removeClass('is-invalid');

            console.log('valid');
            element.setCustomValidity('');
        });

    </script>
@endpush
