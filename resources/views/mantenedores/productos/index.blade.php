@extends('layouts.app', ['title' => __('Products Management')])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-6 center order-xl-1">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Products') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('productos.create') }}"
                                   class="btn btn-success">{{ __('Add Product') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table ">
                        <table class="table align-items-center text-center">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                              {{--  <th scope="col"></th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->name }}</td>
                                    <td>{{ $producto->created_at->format('d/m/Y') }}</td>
                                    {{--<td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            @can('product-edit')
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                       href="{{ route('productos.edit', $producto) }}">{{ __('Edit') }}</a>

                                                </div>
                                            @endcan
                                        </div>
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $productos->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
