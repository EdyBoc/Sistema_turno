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
            <h3 class="page__heading">Modulo Recursos Humanos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-lg"> <i
                                            class="fas fa-street-view">Nuevo</i></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item " href=" "><i class="fas fa-street-view"></i> Nueva
                                            Alta</a>
                                        <a class="dropdown-item " href=" "><i class="fas fa-business-time"></i> Nueva
                                            baja</a>
                                    </div>
                                </div>
                                <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a class="btn btn-danger  btn-lg" id=""><i class="far fa-file-pdf"></i> PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_personas" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> No. </th>
                                            <th class="col-2" style="text-align: center;">Nombre</th>
                                            <th class="col-2" style="text-align: center;"> Fecha alta</th>
                                            <th class="col-2" style="text-align: center;">Estado</th>
                                            <th style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personas as $persona)
                                            <tr>
                                                <td style="text-align: center;">{{ $persona->id_persona }}</td>
                                                <td style="text-align: center;">{{ $persona->nombre_completo }}</td>
                                                <td style="text-align: center;">{{ $persona->fh_contratado }}</td>
                                                <td style="text-align: center;">{{ $persona->estado_texto }}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn-primary btn-sm" id="ver_detalle"><i
                                                            class="far fa-eye"></i></a>
                                                    <a class="btn-primary btn-sm" id="editar_vacacion"><i
                                                            class="far fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

        $(document).ready(function() {
            $('#tabla_personas').DataTable({
                rowReorder: true, // Permitir la reordenación de filas
                lengthMenu: [
                    [4, -1],
                    [4, "All"]
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en la tabla",
                    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
                    "sSearch": "Buscar:",
                    "sPrevious": "Anterior",
                    "sNext": "Siguiente",
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "oPaginate": {
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente"
                    },
                    "sSortAsc": "Ordenar ascendente",
                    "sSortDesc": "Ordenar descendente"
                }
            });
        });
    </script>
@endsection
