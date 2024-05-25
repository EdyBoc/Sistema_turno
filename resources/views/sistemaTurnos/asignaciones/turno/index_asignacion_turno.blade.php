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
            <h3 class="page__heading">Lista Asignacion Turno</h3>
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
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="persona">Selecciona Usuario:</label>
                                    {{ Form::select('usuarios', @$usuarios, null, ['id' => 'id_usuario', 'class' => 'form-control', 'placeholder' => 'Seleccione...']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="catalogo_dependencia">Selecciona Dependencia:</label>
                                    {{ Form::select('catalogo_turno', @$catalogo_turno, null, ['id' => 'id_catalogo_turno', 'class' => 'form-control', 'placeholder' => 'Seleccione...']) }}
                                </div>

                                <div class="form-group col-md-4 d-flex align-items-end">
                                    <a href="#" id="btn_guardar_asignacion_dependencia" class="btn btn-warning"><i
                                            class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> Usuario</th>
                                            <th class="col-2" style="text-align: center;"> Turno</th>
                                            <th class="col-1" style="text-align: center;"> Hr Inicio</th>
                                            <th class="col-1" style="text-align: center;"> Hr Fin</th>
                                            <th class="col-1" style="text-align: center;"> Fecha</th>
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
            $.get("{{ route('filtar_datos_usuario_turno') }}", {
                    id_usuario: $('#id_usuario').val()
                },
                function(response) {
                    console.log(response);
                    response.forEach(function(item) {
                        var fila = '<tr>';
                        fila += '<td style="text-align: center;">' + item.nombre_usuario + '</td>';
                        fila += '<td style="text-align: center;">' + item.nombre_dependencia + '</td>';
                        fila += '<td style="text-align: center;">' + item.inicio + '</td>';
                        fila += '<td style="text-align: center;">' + item.fin + '</td>';
                        fila += '<td style="text-align: center;">' + item.fh_asignacion + '</td>';
                        fila += '<td style="text-align: center;">' + item.estado + '</td>';
                        fila += '</tr>';
                        // Insertar la fila en el cuerpo de la tabla
                        $('#tabla_vacacion tbody').append(fila);
                    });

                });
        });


        $("#btn_guardar_asignacion_dependencia").click(function(e) {
            e.preventDefault();
            var id_usuario = $("#id_usuario").val();
            var id_catalogo_turno = $("#id_catalogo_turno").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_asignacion_turno') }}",
                data: {
                    id_usuario: id_usuario,
                    id_catalogo_turno: id_catalogo_turno,
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
