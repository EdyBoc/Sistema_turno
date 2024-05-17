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

        .notification-icon {
            position: relative;
            display: inline-block;
        }

        .notification-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lista Vacaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center text-center">

                                <div class="col-md-6"> <!-- Columna para el campo de fecha -->
                                    <div class="form-group">
                                        {{ Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'placeholder' => 'Seleccione una fecha']) }}
                                    </div>
                                </div>
                                <div class="col-md-6"> <!-- Columna para el primer botón -->
                                    <a class="btn btn-primary btn-lg" href="{{ route('crear_vacaciones') }}">
                                        <i class="fas fa-street-view"></i> Nuevo
                                    </a>
                                    <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                        Actualizar</a>

                                    <a href="#" class="notification-icon">
                                        <i class="fas fa-bell" style="font-size: 23px;"></i>
                                        @if ($totalReporteHoras > 0)
                                            <span class="badge"
                                                title="Autorizacion de horas Pendientes">{{ $totalReporteHoras }}</span>
                                        @endif
                                    </a>
                                    <a href="#" class="notification-icon">
                                        <i class="fas fa-bell" style="font-size: 23px;"></i>
                                        @if ($totalSolicitudes > 0)
                                            <span class="badge"
                                                title="Autorizacion de horas Pendientes">{{ $totalSolicitudes }}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> No. </th>
                                            <th class="col-2" style="text-align: center;"> Fecha inicio</th>
                                            <th class="col-2" style="text-align: center;"> Fecha final</th>
                                            <th style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vacaciones as $vacacion)
                                            <tr>
                                                <td style="text-align: center;">{{ $vacacion->id_vacacion }}</td>
                                                <td style="text-align: center;">{{ $vacacion->fn_inicio }}</td>
                                                <td style="text-align: center;">{{ $vacacion->fn_fin }}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn-primary btn-sm" id="ver_detalle"><i
                                                            class="far fa-eye"></i></a>
                                                    <a class="btn-primary btn-sm" id="editar_vacacion"
                                                        href="{{ route('crear_vacaciones', ['id_vacacion' => $vacacion['id_vacacion']]) }}"><i
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
            $('#tabla_vacacion').DataTable({
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
