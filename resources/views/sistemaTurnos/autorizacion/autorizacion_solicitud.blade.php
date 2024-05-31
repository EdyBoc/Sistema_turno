@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Autorizar Solicitudes</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_autorizacion') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
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
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-sm" id="tabla_vacacion" cellspacing="0"
                                        style="font-size: 80%;">
                                        <thead>
                                            <tr>
                                                <th class="col-1" style="text-align: center;"> No. </th>
                                                <th class="col-1" style="text-align: center;"> Usuario</th>
                                                <th class="col-1" style="text-align: center;"> Tipo</th>
                                                <th class="col-3" style="text-align: center;"> Obervacion</th>
                                                <th class="col-2" style="text-align: center;"> Mas</th>
                                                <th class="col-2" style="text-align: center;"> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($solicitudes as $solicitud)
                                                <tr>
                                                    <td style="text-align: center;">{{ $solicitud->id_solicitud }}</td>
                                                    <td style="text-align: center;">{{ $solicitud->user }}</td>
                                                    <td style="text-align: center;">{{ $solicitud->tipo_solicitud }}</td>
                                                    <td style="text-align: center;">{{ $solicitud->obervacion }}</td>
                                                    <td style="text-align: center;"> <!-- Nueva columna "Más" -->
                                                        <select class="custom-select">
                                                            <option selected>Mas...</option>
                                                            <option value="fecha">Fecha:{{ $solicitud->fecha_solicitud }}
                                                            </option>
                                                        </select>
                                                    </td>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a data-toggle="modal" data-target="#modal_add_solicitud"
                                                            data-id="{{ $solicitud->id_solicitud }}"
                                                            data-user="{{ $solicitud->user }}"
                                                            data-tipo_solicitud="{{ $solicitud->tipo_solicitud }}"
                                                            class="btn text-center editar_solicitud">
                                                            <i class="fas fa-user-cog text-primary"></i>Autorizar</a>
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
    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Crear Autorizacion</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Selccione Tipo de Autorizacion:</label>
                        <div class="input-group">
                            <select id="tipo_autorizacion" class="custom-select" title="Tipo de Autorizacion">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">Autorizado</option>
                                <option value="0">Denegado</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="TIpo de Solicitud">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comentario">Comentario:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="comentario" name="comentario" required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Comentario">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="id_solicitud" readonly>

                    <div class="form-group">
                        <label for="comentario">Usurio:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="user" name="user" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Comentario">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comentario">Tipo Solicitud:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="tipo_solicitud" name="tipo_solicitud"
                                readonly>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Comentario">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_solicitud').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_autorizacion" class="btn btn-success btn-lg"><i
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

        $(document).ready(function() {
            $('.editar_solicitud').on('click', function() {
                var id = $(this).data('id');
                var user = $(this).data('user');
                var tipo_solicitud = $(this).data('tipo_solicitud');

                $('#id_solicitud').val(id);
                $('#user').val(user);
                $('#tipo_solicitud').val(tipo_solicitud);
            });
        });


        $("#btn_guardar_autorizacion").click(function(e) {
            e.preventDefault();
            var id_solicitud = $("#id_solicitud").val();
            var comentario = $("#comentario").val();
            var tipo_autorizacion = $("#tipo_autorizacion").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_solicitud_editado') }}",
                data: {
                    id_solicitud: id_solicitud,
                    comentario: comentario,
                    tipo_autorizacion: tipo_autorizacion,
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
