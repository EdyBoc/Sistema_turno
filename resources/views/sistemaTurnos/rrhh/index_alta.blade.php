@extends('layouts.app')

@section('page_css')
    <style>
        .table thead th {
            background-color: #6b6e86;
            color: rgb(255, 255, 255);
            /* Color de fondo azul claro */
        }

        /* Estilo para la tabla */
        .table {
            border-collapse: separate;
            width: 100%;
            border-radius: 10px;
            /* Borde redondeado para la tabla */
            overflow: hidden;
            /* Para que los bordes redondeados se vean correctamente */
        }

        /* Estilo para las celdas de la tabla */
        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 10px;
            /* Ajuste el espaciado de las celdas aquí */
        }

        /* Estilo para las filas impares */
        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
            color: black;
        }

        /* Estilo para la fila de detalles */
        .detalles {
            background-color: #ffffff;
            /* Color de fondo */
            border-radius: 10px;
            /* Borde redondeado para la fila de detalles */
        }
    </style>
@endsection


@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Formulario</h3>
        </div>
        <div class="section-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <h5 class="page__heading">Nueva Alta</h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" class="form-control" id="id_persona" name="id_persona"
                                            value="{{ isset($persona) ? $persona->id_persona : null }}" required>
                                        <div class="form-group">
                                            <label for="cui">CUI:</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="cui" name="cui"
                                                    value="{{ isset($persona) ? $persona->cui : null }}"
                                                    @if (isset($persona->cui)) readonly @endif>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip" title="CUI">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="pais">País:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="pais" name="pais"
                                                    value="{{ isset($persona) ? $persona->pais : null }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip" title="País">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nit">NIT:</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="nit" name="nit"
                                                    value="{{ isset($persona) ? $persona->nit : null }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip" title="NIT">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="correo_electronico">Correo Electrónico:</label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" id="correo_electronico"
                                                    name="correo_electronico"
                                                    value="{{ isset($persona) ? $persona->correo_electronico : null }}"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Correo Electrónico">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre_completo">Nombre Completo:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nombre_completo"
                                                    name="nombre_completo"
                                                    value="{{ isset($persona) ? $persona->nombre_completo : null }}"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Nombre Completo">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="departamento">Departamento:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="departamento"
                                                    name="departamento"
                                                    value="{{ isset($persona) ? $persona->departamento : null }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Departamento">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="direccion">Dirección:</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="direccion"
                                                    name="direccion"
                                                    value="{{ isset($persona) ? $persona->direccion : null }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Dirección">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fh_nacimiento">Fecha de Nacimiento:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="fh_nacimiento"
                                                    name="fh_nacimiento"
                                                    value="{{ isset($persona) ? $persona->fh_nacimiento : null }}"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Fecha de Nacimiento">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="telefono">Teléfono:</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="telefono"
                                                    name="telefono"
                                                    value="{{ isset($persona) ? $persona->telefono : null }}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Teléfono">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sexo">Sexo:</label>
                                            <div class="input-group">
                                                <select id="sexo" class="custom-select" name="sexo"
                                                    title="Sexo" required>
                                                    <option value="" disabled selected>Seleccione...</option>
                                                    <option value="M"
                                                        {{ isset($persona) && $persona->sexo == 'M' ? 'selected' : '' }}>
                                                        Masculino</option>
                                                    <option value="F"
                                                        {{ isset($persona) && $persona->sexo == 'F' ? 'selected' : '' }}>
                                                        Femenino</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Sexo">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-danger btn-lg" href="{{ route('lista_personas') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a href="#" id="btn_guardar_alta" class="btn btn-success btn-lg"><i
                                        class="fas fa-save"></i>&nbsp;Guardar</a>

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

        $("#btn_guardar_alta").click(function(e) {
            e.preventDefault();
            var id_persona = $("#id_persona").val();
            var cui = $("#cui").val();
            var nombre_completo = $("#nombre_completo").val();
            var telefono = $("#telefono").val();
            var correo_electronico = $("#correo_electronico").val();
            var fh_nacimiento = $("#fh_nacimiento").val();
            var direccion = $("#direccion").val();
            var sexo = $("#sexo").val();
            var nit = $("#nit").val();
            var departamento = $("#departamento").val();
            var pais = $("#pais").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_altas') }}",
                data: {
                    id_persona: id_persona,
                    cui: cui,
                    nombre_completo: nombre_completo,
                    telefono: telefono,
                    correo_electronico: correo_electronico,
                    fh_nacimiento: fh_nacimiento,
                    direccion: direccion,
                    sexo: sexo,
                    nit: nit,
                    departamento: departamento,
                    pais: pais,
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
