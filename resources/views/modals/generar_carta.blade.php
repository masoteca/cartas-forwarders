<div class="modal fade" id="modal-carta" tabindex="-1" role="dialog" aria-labelledby="modal-carta" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered" role="document" style="max-width: 1200px!important;">

        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title ">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-body px-lg-1 py-lg-1">

                        {!! Form::open(['method'=> 'POST','class' => 'mx-3 mb-3', 'id' => 'form-datos-carta' ,'route' => ['cartas.store']]) !!}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::label('awb', 'AWB') !!}
                                {!! Form::text('awb',null,['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('destination', 'Destination') !!}
                                {!! Form::select('destination', $destinations , null, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}

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
                                {!! Form::select('product', $products , null, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('airline', 'Aerolinea') !!}
                                {!! Form::select('airline', $airlines , null, ['class' => 'form-control', 'placeholder' => 'Escoja']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('encargado', 'Encargado') !!}
                                {!! Form::text('encargado',null,['class'=> 'form-control']) !!}
                            </div>
                            <div class="col-6 my-4">
                                <button type="button" class="btn btn-danger" id="cancel-carta" data-dismiss="modal"
                                        aria-label="Close">
                                    Cancelar
                                </button>
                                {!! Form::submit('Guardar',['class'=> 'btn btn-success', 'id' => 'guardar-carta-datos']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{asset('js/sweetalert.js')}}"></script>
    <script>
        $(document).ready(() => {
            $('#destination').on('change', function () {
                $('#iata_code').val(this.value)
            })
            $('#airline').on('change', function () {
                $('#awb').val(this.value)
            })
            $('#cancel-carta').on('click', function () {
                $('#form-datos-carta').trigger("reset");
            })
            $('#form-datos-carta').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function (data) {
                        Swal.fire({
                            title: 'Resgistro Creado',
                            text: "Deseas Duplicar la información?",
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'No duplicar datos',
                            cancelButtonText: 'Si! Duplicar datos',
                        }).then((result) => {
                            if (result.value) {
                                form.trigger('reset')
                            }
                        })
                    },
                    error: function (error) {
                        alert(error)
                    }
                });

            })
        })
    </script>

@endpush
