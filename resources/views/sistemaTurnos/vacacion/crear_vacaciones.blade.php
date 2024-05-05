@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Vacaciones| crear</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="/index_vacaciones"><i
                                        class="fa fa-times"></i>Cancelar</a>
                                <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a class="btn btn-primary btn-lg" id="btn_consultar"> Consultar</a>
                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleSelect">Selecciona Trabajador:</label>
                                        {{ Form::select('persona', @$persona, null, ['id' => 'persona', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Edad:</label>
                                        <input type="number" class="form-control" id="edad" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="for_fecha_contratado">fecha Ingreso:</label>
                                        <input type="date" class="form-control" id="fecha_contratado" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="for_correo_electronico">Correo Electronico:</label>
                                        <input type="text" class="form-control" id="correo_electronico" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="">Formulario de Autorizacion</label>
                                <details class="col-lg-12">
                                    <summary>Detalles</summary>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" class="form-control" id="id_catalogo_editar">
                                            <div class="form-group">
                                                <label for="nombre">Emisor:</label>
                                                <input type="text" class="form-control" id="nombre_catalogo">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nombre">Seleccione autizacion:</label>
                                                <input type="text" class="form-control" id="descripcion_catalogo"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nombre">Periodo de Vacaciones:</label>
                                                <input type="date" class="form-control" id="descripcion_catalogo"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" class="form-control" id="id_catalogo_editar">
                                            <div class="form-group">
                                                <label for="nombre">diaz Gozados:</label>
                                                {{ Form::select('dia_gozado', @$dias, null, ['id' => 'id_gozados', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nombre">dias rezagados:</label>
                                                <input type="number" class="form-control" id="descripcion_catalogo"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nombre">fecha inicio:</label>
                                                <input type="date" class="form-control" id="descripcion_catalogo">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="nombre">fecha finlizado:</label>
                                                <input type="date" class="form-control" id="descripcion_catalogo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="justify-content-center text-center">
                                        <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg "><i
                                                class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#btn_actualizar").click(function() {
                location.reload();
            });
        });

        $('#persona').change(function() {
            $.get("{{ route('filtar_persona') }}", {
                    persona: $('#persona').val()
                },
                function(data) {
                    var cui = data.cui;
                    var correo_electronico = data.correo_electronico;
                    var edad = data.edad;
                    var fecha_contratado = data.fecha_contratado;
                    $('#cui').val(cui);
                    $('#correo_electronico').val(correo_electronico);
                    $('#edad').val(edad);
                    $('#fecha_contratado').val(fecha_contratado);

                });
        });
    </script>
@endsection