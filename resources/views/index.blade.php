@extends('layouts.app')

@section('content')
    {{--    @include('layouts.headers.cards')--}}
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
                        @foreach( $cartas as $dia => $contenido)
                            <div class="card shadow">
                                <div class="card-body">

                                    <div class="table">
                                        <h4> {{ \Carbon\Carbon::createFromDate($dia)->format('l')}}  {{ $dia }}</h4>
                                        <table class="table align-items-center">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">AWB</th>
                                                <th scope="col">Airline</th>
                                                <th scope="col">Destination</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Encargado</th>

                                                <th scope="col" style="width: 5%">Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $contenido as $carta)
                                                <tr>
                                                    <td>{{$carta->awb}}</td>
                                                    <td>{{$carta->airline->name}}</td>
                                                    <td>{{$carta->destination->country }}</td>
                                                    <td>{{$carta->product->name }}</td>
                                                    <td>{{$carta->encargado->nombre }}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-md btn-icon-only text-light bg-gradient-lighter"
                                                               href="#"
                                                               role="button"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                <a class="dropdown-item" target="_blank"
                                                                   href="{{ route('document.print', $carta) }}">Imprimir Carta</a>
                                                                {{-- <a class="dropdown-item"  href="{{ route('etiquetas.print', $carta) }}">Imprimir  Etiqueta</a>--}}
                                                                <a class="dropdown-item"
                                                                   href="{{ route('document.edit', $carta) }}">{{ __('Edit') }}</a>
                                                                <form action="{{ route('document.destroy', $carta) }}"
                                                                      id="form-delete-document-{{$carta->id}}"
                                                                      method="post">
                                                                    @csrf
                                                                    @method('delete')

                                                                    <button type="button" class="dropdown-item"
                                                                            {{--        onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">--}}
                                                                            onclick="deletecartadata({{$carta->id}})">
                                                                        {{ __('Delete') }}
                                                                    </button>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.generar_carta')

@endsection

@push('js')
    <script>

        function deletecartadata(id) {
            Swal.fire({

                text: "Seguro que deseas eliminar este registro?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'No, No Eliminar',
                confirmButtonText: 'Si! Eliminar',

            }).then((result) => {
                if (result.value) {
                    let form = $('#form-delete-document-' + id)
                    form.trigger('submit');
                }
            })
        }

    </script>
@endpush
