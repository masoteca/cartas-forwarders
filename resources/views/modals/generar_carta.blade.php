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

                        {!! Form::open(['method'=> 'POST','class' => 'mx-3 mb-3', 'id' => 'form-datos-carta' ,'route' => ['document.store']]) !!}
                        <div class="row">

                            <div class="col-6">
                                {!! Form::label('airline', 'Aerolinea') !!}
                                {!! Form::select('airline', $airlines , null, ['class' => 'form-control', 'required', 'placeholder' => 'Escoja']) !!}
                            </div>

                            <div class="col-6">
                                {!! Form::label('awb', 'AWB') !!}
                                {!! Form::text('awb',null,['class'=> 'form-control', 'required', 'maxlength' => 12]) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('destination', 'Destination') !!}
                                {!! Form::select('destination', $destinations , null, ['class' => 'form-control', 'required', 'placeholder' => 'Escoja']) !!}

                            </div>
                            <div class="col-6">
                                {!! Form::label('iata_code', 'Codigo IATA') !!}
                                {!! Form::text('iata_code',null,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('fecha_envio', 'Fecha del día') !!}
                                {!! Form::date('fecha_envio',null,['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-6">
                                {!! Form::label('product', 'Producto') !!}
                                {!! Form::select('product', $products , null, ['class' => 'form-control', 'required', 'placeholder' => 'Escoja']) !!}
                            </div>

                            <div class="col-6">
                                {!! Form::label('encargado', 'Encargado') !!}
                                {!! Form::select('encargado', $encargados , null, ['class' => 'form-control', 'required', 'placeholder' => 'Escoja']) !!}
                            </div>

                        </div>


                        <div class="text-center my-4">
                            <button type="button" class="btn btn-danger" id="cancel-carta" data-dismiss="modal"
                                    aria-label="Close"> Cancelar
                            </button>
                            {!! Form::submit('Guardar',['class'=> 'btn btn-success', 'id' => 'guardar-carta-datos']) !!}
                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{asset('js/jquery.validate.js')}}" type="application/javascript"></script>
    <script>
        $(document).ready(() => {
            $('#destination').on('change', function () {
                $('#iata_code').val(this.value)
            });
            $('#airline').on('change', function () {
                $('#awb').val(this.value + '-')
            });
            $('#cancel-carta').on('click', function () {
                $('#form-datos-carta').trigger("reset");
            });
            $('#awb').on('change', function () {
                let tempval = this.value;
                let splited = tempval.split('-');
                if (splited[1] == void (0) || splited[0] == void (0) || splited[0] == '') {
                    this.value = $('#airline').val() + '-';
                    $('#awb').addClass('is-invalid');
                } else if (splited[1].length > 8) {
                    this.value = $('#airline').val() + '-';
                    $('#awb').addClass('is-invalid');
                } else {
                    $('#awb').removeClass('is-invalid')
                }
            });

            $("#form-datos-carta").validate({

                messages: {
                    'destination': "El destino es requerido",
                    'airline': "aerolinea es requerida",
                    'awb': "la AWB es requerida",
                    'iata_code': "El codigo IATA es requerido",
                    'fecha_envio': "La fecha es requerida",
                    'product': "Indique el producto",
                    'encargado': "Indique un encargado"
                },
                errorClass: 'is-invalid',
                validClass: '',
                submitHandler: function (form) {
                    var formData = $("#form-datos-carta").serialize();
                    $.ajax({
                        type: "POST",
                        url: '{{route('document.store')}}',
                        data: formData,
                        success: function (msg) {

                            if (msg.carta) {

                                $('#modal-carta').modal('hide');
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
                                        $("#form-datos-carta").trigger("reset");
                                        window.location.reload();
                                    } else {
                                        $('#modal-carta').modal('show');
                                    }
                                })
                            }
                        }
                    });
                }
            });
        })


    </script>

@endpush
