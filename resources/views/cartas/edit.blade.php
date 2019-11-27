@extends('layouts.app')


@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-darker ls-1 mb-1">Modificar Datos</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::model($documento,['method'=> 'PUT','class' => 'mx-3 mb-3', 'id' => 'form-datos-carta' ,'route' => ['document.update', $documento]]) !!}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('airline', 'Aerolinea') !!}
                                {!! Form::select('airline', $airlines ,  $documento->airline->prefix, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('awb', 'AWB') !!}
                                {!! Form::text('awb',null,['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('destination', 'Destination') !!}
                                {!! Form::select('destination', $destinations , $documento->destination->code, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('iata_code', 'Codigo IATA') !!}
                                {!! Form::text('iata_code',null,['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('fecha_envio', 'Fecha del día') !!}
                                {!! Form::date('fecha_envio',null,['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('product', 'Producto') !!}
                                {!! Form::select('product', $products , $documento->id_product, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>

                            <div class="col-6">
                                {!! Form::label('encargado', 'Encargado') !!}
                                {!! Form::select('encargado', $encargados , $documento->rut_encargado, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>

                        </div>

                        <div class="text-center my-4">
                            <a href="{{route('document.index')}}" class="btn btn-danger" id="cancel-carta" data-dismiss="modal"
                                    aria-label="Close"> Cancelar
                            </a>
                            {!! Form::submit('Guardar',['class'=> 'btn btn-success', 'id' => 'guardar-carta-datos']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
