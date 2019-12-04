@extends('layouts.app')

@section('content')

    <div class="container-fluid mt--7">
        <div class="row">

            <div class="col-xl-6 center order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('New Destination') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('destinos.update',['destino' => $destino->id]) }}" autocomplete="off">
                            @method('PUT')
                            @csrf

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" >{{ __('Destination') }}</label>
                                    <input type="text" name="country"  value="{{$destino->country}}" class="form-control form-control-alternative{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('Destination') }}" required autofocus>

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('IATA CODE') }}</label>
                                    <input type="text" maxlength="5" value="{{$destino->code}}" name="code" class="form-control form-control-alternative{{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="{{ __('IATA CODE') }}" required >

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('code') }}</strong>
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
