@extends('layouts.app')

@section('content')
    {{--    @include('layouts.headers.cards')--}}
    @include('layouts.partials.header')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-lighter shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-darker ls-1 mb-1">Proximos días</h6>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0">
                                        <button type="button" class="btn btn-block btn-outline-danger"
                                                data-toggle="modal"
                                                data-target="#modal-carta" data-toggle="tooltip" data-placement="top"
                                                title="Usalo para llenar datos para una nueva carta de seguridad">
                                            Agregar Carta
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.generar_carta')
    @include('layouts.footers.auth')
@endsection

@push('js')

@endpush
