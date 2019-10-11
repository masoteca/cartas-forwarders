@extends('layouts.app')


@section('content')
    @include('layouts.partials.header')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Roles Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('roles.index') }}"
                                   class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        <div class="pl-lg-4">

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Role Name') }}</label>
                                <input type="text" name="name" id="input-name"
                                       class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="row">

                                    <strong>Permisos:</strong>
                                    <br/>
                                    @foreach($permission as $value)
                                        <div class="col">
                                            {{ $value->name }}<span class="clearfix"></span>
                                             <label class="custom-toggle">
                                                {{ Form::checkbox('permission[]',
                                                $value->id, false, array('class' => 'name')) }}
                                                <span class="custom-toggle-slider rounded-circle"></span>
                                            </label>


                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
