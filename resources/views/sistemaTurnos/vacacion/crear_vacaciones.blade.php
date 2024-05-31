@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Formulario| crear</h3>
        </div>
        <div class="section-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <div class="justify-content-center text-center">
                                <h5 class="page__heading">Asignar</h5>

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">
                                            <label for="nombre_completo">Nombre Completo:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nombre_completo"
                                                    name="nombre_completo"
                                                    value="{{ isset($persona) ? $persona->nombre_completo : null }}"
                                                    readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Nombre Completo">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha_contratado">Fecha Contratado:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="fecha_contratado"
                                                    name="fecha_contratado"
                                                    value="{{ isset($persona) ? $persona->fh_contratado : null }}" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Fecha Contratado">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha_contratado">Descripcion:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="descripcion"
                                                    name="descripcion" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Fecha Contratado">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="correo_electronico">Correo Electrónico:</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" id="correo_electronico"
                                                    name="correo_electronico"
                                                    value="{{ isset($persona) ? $persona->correo_electronico : null }}"
                                                    readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Correo Electrónico">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha_contratado">Fecha inicio:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="fn_inicio" name="fn_inicio">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Fecha Inicio">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="fecha_contratado">Fecha fin:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="fn_fin" name="fn_fin">
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Fecha Fin">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="justify-content-center text-center">
                                    <a class="btn btn-danger btn-lg" href="{{ route('index_vacaciones') }}"><i
                                            class="fas fa-reply"></i></i>Regrar</a>
                                    <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg "><i
                                            class="fas fa-plus-circle"></i>&nbsp;Guardar</a>

                                </div>
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
