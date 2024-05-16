@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Lista Mis Solicitudes</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_perfil') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>

                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_solicitud"><i
                                        class="fas fa-street-view"></i> Nuevo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_personas" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tipo</th>
                                            <th>Motivo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Registro</td>
                                            <td>Creación de usuario</td>
                                            <td>14/05/2024</td>
                                            <td>Aceptado</td>
                                            <td>Puede Proceder</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Catálogo</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Seleccionar tipo Solicitud:</label>
                        <div class="input-group">
                            <select id="tipo_solicitud" class="custom-select" title="Tipo de Solicitud">
                                <option selected>Seleccione...</option>
                                <option value="P">Permiso</option>
                                <option value="V">Vacacion</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="TIpo de Solicitud">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <label for="fr_catalogo_nombre">Comentario:</label>
                    <textarea class="form-control form-control-lg" id="comentario_solicitud" rows="10"></textarea>

                </div>

                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_solicitud').modal('hide');" class="btn btn-danger btn-lg"><i
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

        $("#btn_guardar_catalogo").click(function(e) {
            e.preventDefault();
            var tipo_solicitud = $("#tipo_solicitud").val();
            var comentario_solicitud = $("#comentario_solicitud").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_solicitud') }}",
                data: {
                    tipo_solicitud: tipo_solicitud,
                    comentario_solicitud: comentario_solicitud
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                    }
                }
            });
        });
    </script>
@endsection
