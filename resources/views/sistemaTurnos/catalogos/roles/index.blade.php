@extends('layouts.app')

@section('page_css')
    <style>
        .dropdown-menu {
            min-width: auto;
            width: auto;
        }

        .select-rounded {
            border: 1px solid #ccc;
            border-radius: 5px;
        }

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

        .modal {
            z-index: 1050;
            /* Ajusta este valor según sea necesario */
        }
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lista Catalogo Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="/index_catalogo"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary btn-lg" data-toggle="modal"
                                    data-target="#modal_add_catalogo_rol"><i class="fas fa-street-view"></i> Nuevo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="container d-flex justify-content-center align-items-center">
                                    <div class="loader" id="loader"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm" id="listadoTabla" cellspacing="0" style="font-size: 80%;">
                                        <thead>
                                            <tr>
                                                <th class="col-1" style="text-align: center;"> No. </th>
                                                <th class="col-2" style="text-align: center;"> Nombre</th>
                                                <th class="col-2" style="text-align: center;"> Descripción</th>
                                                <th class="col-2" style="text-align: center;"> Fecha</th>
                                                <th class="col-2" style="text-align: center;"> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($catalogo_roles as $catalogo_rol)
                                                <tr>
                                                    <td style="text-align: center;">{{ $catalogo_rol->id_catalogo_rol }}
                                                    </td>
                                                    <td style="text-align: center;">{{ $catalogo_rol->nombre }}</td>
                                                    <td style="text-align: center;">{{ $catalogo_rol->descripcion }}</td>
                                                    <td style="text-align: center;">{{ $catalogo_rol->fn_catalogo_rol }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a class="btn-primary btn-sm" id="editar_rol">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
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
        </div>
    </section>

    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_catalogo_rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Rol</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="catalogo_rol">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Descripcion:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descripcion">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Descripcion">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_rol').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_rol" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#btn_actualizar").click(function() {
                location.reload();
            });
        });

        $("#btn_guardar_catalogo_rol").click(function(e) {
            e.preventDefault();
            var catalogo_rol = $("#catalogo_rol").val();
            var descripcion = $("#descripcion").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_catalogo_rol') }}",
                data: {
                    catalogo_rol: catalogo_rol,
                    descripcion: descripcion,
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
