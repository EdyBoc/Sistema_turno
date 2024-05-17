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
                                <a class="btn btn-danger btn-lg" href="{{ route('index_asignacion') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-sm" id="listadoTabla" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <th style="text-align: center;"> No. </th>
                                        <th style="text-align: center;"> Nombre </th>
                                        <th style="text-align: center;"> Email </th>
                                        <th style="text-align: center;"> Rol </th>
                                        <th style="text-align: center;"> Estado </th>
                                        <th style="text-align: center;" width="60"> Acciones</th>
                                    </thead>
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

        $('#avanzado').on('change keyup', function(e) {
            var keyCode = e.keyCode || e.which;
            if ((keyCode == 13)) {
                $('#listadoTabla').DataTable().ajax.reload();
            }
        });

        //busqueda por filtros
        $("#btnBuscar").click(function() {
            event.preventDefault();
            $('#listadoTabla').DataTable().ajax.reload();
        });

        //CARGA DE DATOS EN LA LISTA
        $('#listadoTabla').DataTable({
            columnDefs: [{
                className: "dt-body-center",
                orderable: false,
                targets: "_all"
            }],
            lengthMenu: [
                [4, -1],
                [4, "All"]
            ],
            order: [0, 'desc'],
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
            },
            bFilter: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('listar_usuarios') }}",
                type: 'POST',
                data: function(d) {
                    d.avanzado = $("#avanzado").val();
                    d.estado = $("#estado").val();
                }
            }
        });
        $.fn.dataTable.ext.errMode = 'throw';
    </script>
@endsection
