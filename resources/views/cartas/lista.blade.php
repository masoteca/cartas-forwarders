@extends('layouts.app')


@section('content')
    @include('layouts.partials.header')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-darker ls-1 mb-1">Todas las cartas</h6>
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
                        <div class="table-responsive">

                            <table id="table-cartas-full" class="table align-items-center">
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
                                @foreach( $cartas as $carta)
                                    <tr>
                                        <td>{{$carta->awb}}</td>
                                        <td>{{$carta->airline->name}}</td>
                                        <td>{{$carta->destination->country }}</td>
                                        <td>{{$carta->product->name }}</td>
                                        <td>{{$carta->encargado }}</td>
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
                                                    <a class="dropdown-item"
                                                       href="{{ route('cartas.print', $carta) }}">Imprimir Carta</a>
                                                    @can('user-edit')
                                                        <a class="dropdown-item"
                                                           href="{{ route('user.edit', $carta) }}">{{ __('Edit') }}</a>
                                                    @endcan
                                                    @can('user-delete')
                                                        <form action="{{ route('user.destroy', $carta) }}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="button" class="dropdown-item"
                                                                    {{--        onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">--}}
                                                                    onclick="deletecartadata() === true ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>

                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">

                        {{-- {{ $cartas->links() }}--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.generar_carta')
@endsection

@push('js')

    <script>
        $(document).ready(function () {
            $('#table-cartas-full').DataTable();
        });

        function deletecartadata() {
            Swal.fire({

                text: "Seguro que deseas eliminar este registro?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonText: 'No, No Eliminar',
                confirmButtonText: 'Si! Eliminar',

            }).then((result) => {
                if (result.value) {
                    return true;
                }
            })
        }

    </script>
@endpush
