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
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <a class="btn btn-danger btn-lg" href="/index_catalogo"><i
                                                class="fas fa-reply"></i></i>Regrar</a>
                                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                                            data-target="#modal_add_catalogo"><i class="fas fa-street-view"></i> Nuevo
                                            Catalogo</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        <input type="text" placeholder="Búsqueda Rápida" class="form-control"
                                            id="avanzado" name="avanzado">
                                        <div class="input-group-append">
                                            <button id="btnBuscar" class="btn btn-primary" type="button"
                                                data-toggle="tooltip" title="Buscar">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        {{ Form::select('catalogo', @$catalogo, null, ['id' => 'id_catalogo', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}

                                        <a class="btn btn-primary" type="button" data-toggle="modal"
                                            data-target="#modal_add_catalogo_editar" data-toggle="tooltip" title="Buscar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <a class="btn btn-primary btn-lg" data-toggle="modal"
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
                                <table class="table table-bordered table-striped" id="listadoTabla" cellspacing="0"
                                    style="font-size: 12px;">
                                    <thead>
                                        <th style="text-align: center;"> No. </th>
                                        <th style="text-align: center;"> Nombre </th>
                                        <th style="text-align: center;"> Descripción </th>
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

    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_catalogo" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Catalgo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="catalogo_nombre">
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


    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_catalogo_editar" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Editar Catalgo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="catalogo_nombre_editar">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_editar').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_editar" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_catalogo_items" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Catalgo Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_nombre_catalogo_editar">Catalogo:</label>
                        <input type="text" class="form-control" id="nombre_catalogo_editar" readonly>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_items').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_items" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_editar_catalogo" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Items | Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" class="form-control" id="id_catalogo_editar">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_catalogo_items">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a id="btnCerrar" onclick="$('#modal_add_editar_catalogo').modal('hide');"
                            class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                        &nbsp;
                        <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg"><i
                                class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                    </div>
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
            order: [0, 'desc'],
            bFilter: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('listar') }}",
                type: 'POST',
                data: function(d) {
                    d.avanzado = $("#avanzado").val();
                    d.estado = $("#estado").val();
                }
            }
        });
        $.fn.dataTable.ext.errMode = 'throw';


        $(document).ready(function() {
            $('#modal_add_editar').modal('hide');
        });

        function modalEditarCatalogo(id_catalogo) {
            $('#modal_add_editar_catalogo').modal('show');

            var id_catalogo = id_catalogo;
            $('#id_catalogo_editar').val(id_catalogo);
            // Actualiza la tabla
        }

        $("#btn_guardar_catalogo").click(function(e) {
            e.preventDefault();
            var nombre = $("#catalogo_nombre").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_catalogo') }}",
                data: {
                    nombre: nombre
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                        $('#loader').hide();

                    } else {
                        toastr.success(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    }
                }
            });
        });

        $('#id_catalogo').change(function() {
            var id_catalogo_seleccionado = $(this).val();
            var nombre_seleccionado = $(this).find('option:selected').text();

            $('#id_catalogo_editar').val(id_catalogo_seleccionado);
            $('#nombre_catalogo_editar').val(nombre_seleccionado);
        });
    </script>
@endsection
