@extends('layouts.app')

@section('page_css')
    <style>

    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lista Catalogo Dependencia</h3>
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
                                                        <a data-toggle="modal" data-target="#modal_add_editado_catalogo_rol"
                                                            data-id="{{ $catalogo_rol->id_catalogo_rol }}"
                                                            data-nombre="{{ $catalogo_rol->nombre }}"
                                                            data-descripcion="{{ $catalogo_rol->descripcion }}"
                                                            class="btn text-center editar_turno">
                                                            <i class="fas fa-edit text-primary"></i> Editar
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


    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_editado_catalogo_rol" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Editar Rol</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="id_catalogo_rol">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="editado_nombre">
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
                            <input type="text" class="form-control" id="editado_descripcion">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Descripcion">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_editado_catalogo_rol').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_editado_catalogo_rol" class="btn btn-success btn-lg"><i
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

        $(document).ready(function() {
            $('.editar_turno').on('click', function() {
                var id = $(this).data('id');
                var nombre = $(this).data('nombre');
                var descripcion = $(this).data('descripcion');
                $('#id_catalogo_rol').val(id);
                $('#editado_nombre').val(nombre);
                $('#editado_descripcion').val(descripcion);
            });
        });


        $("#btn_editado_catalogo_rol").click(function(e) {
            e.preventDefault();
            var id_catalogo_rol = $("#id_catalogo_rol").val();
            var editado_nombre = $("#editado_nombre").val();
            var editado_descripcion = $("#editado_descripcion").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_rol_editado') }}",
                data: {
                    id_catalogo_rol: id_catalogo_rol,
                    editado_nombre: editado_nombre,
                    editado_descripcion: editado_descripcion,
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
