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
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lista Asignacion Roles</h3>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger " href="{{ route('index_asignacion') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary " id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="persona">Selecciona Usuario:</label>
                                    {{ Form::select('usuarios', @$usuarios, null, ['id' => 'id_usuario', 'class' => 'form-control', 'placeholder' => 'Seleccione...']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="catalogo_dependencia">Selecciona Dependencia:</label>
                                    {{ Form::select('catalogo_rol', @$catalogo_rol, null, ['id' => 'id_catalogo_rol', 'class' => 'form-control', 'placeholder' => 'Seleccione...']) }}
                                </div>

                                <div class="form-group col-md-4 d-flex align-items-end">
                                    <a href="#" id="btn_guardar_asignacion_rol" class="btn btn-warning"><i
                                            class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_roles" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> Usuario </th>
                                            <th class="col-1" style="text-align: center;"> Rol</th>
                                            <th class="col-2" style="text-align: center;"> Fecha Asignado</th>
                                            <th class="col-1" style="text-align: center;"> Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id_persona" readonly>
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombrre:</label>
                                    <input type="text" class="form-control" id="nombre_completo" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cui">Cui:</label>
                                    <input type="text" class="form-control" id="cui" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="fh_contratado">Fecha Contratado:</label>
                                    <input type="text" class="form-control" id="fh_contratado" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="estado">Estado:</label>
                                    <input type="text" class="form-control" id="estado" readonly>
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

        $('#id_usuario').change(function() {
            var idUsuario = $('#id_usuario').val();
            if (idUsuario) {
                $.get("{{ route('filtar_datos_usuario_rol') }}", {
                        id_usuario: $('#id_usuario').val()
                    },
                    function(response) {
                        response.forEach(function(item) {
                            var fila = '<tr>';
                            fila += '<td style="text-align: center;">' + item.nombre_usuario + '</td>';
                            fila += '<td style="text-align: center;">' + item.nombre_rol + '</td>';
                            fila += '<td style="text-align: center;">' + item.fh_asignacion + '</td>';
                            fila += '<td style="text-align: center;">' + item.estado + '</td>';
                            fila += '</tr>';
                            // Insertar la fila en el cuerpo de la tabla
                            $('#tabla_roles tbody').append(fila);
                        });

                    });
            } else {
                toastr.warning('Por favor, selecciona una opción.');
            }
        });


        $('#id_usuario').change(function() {
            var idUsuario = $('#id_usuario').val();
            if (idUsuario) {
                $.get("{{ route('consulta_recursos_humanos') }}", {
                    id_usuario: idUsuario
                }, function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        $('#id_persona').val(response.id_persona).closest('.input-group').show();
                        $('#nombre_completo').val(response.nombre_completo).closest('.input-group').show();
                        $('#cui').val(response.cui).closest('.input-group').show();
                        $('#fh_contratado').val(response.fh_contratado).closest('.input-group').show();
                        $('#estado').val(response.estado).closest('.input-group').show();
                    }
                });
            } else {
                toastr.error(' ');
            }
        });


        $("#btn_guardar_asignacion_rol").click(function(e) {
            e.preventDefault();
            var id_usuario = $("#id_usuario").val();
            var id_persona = $("#id_persona").val();
            var id_catalogo_rol = $("#id_catalogo_rol").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_asignacion_rol') }}",
                data: {
                    id_usuario: id_usuario,
                    id_persona: id_persona,
                    id_catalogo_rol: id_catalogo_rol,
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                        location.reload();
                    } else {
                        toastr.success(response.message);
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
