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
            <h3 class="page__heading">Listado Catalogos Items</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <a class="btn btn-danger btn-lg" href="/index_catalogo"><i
                                                class="fas fa-reply"></i></i>Regrar</a>
                                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                                            data-target="#modal_add_catalogo"><i class="fas fa-street-view"></i> Nuevo
                                            Catalogo</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <a id="btn_creacion_catalogo" class="btn btn-primary btn-lg" data-toggle="modal"
                                        data-target="#modal_add_catalogo_items"><i class="fas fa-street-view"></i> Crear
                                        Catalogo
                                        hijo</a>

                                </div>
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
                                                <th style="text-align: center;"> Acciones</th>
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
                                                        <a class="btn-primary btn-sm" id="ver_detalle"><i
                                                                class="far fa-eye"></i></a>
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
    <div class="modal fade" id="modal_add_catalogo_items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Catálogo</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="catalogo_nombre">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo" class="btn btn-success btn-lg"><i
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
    </script>
@endsection
