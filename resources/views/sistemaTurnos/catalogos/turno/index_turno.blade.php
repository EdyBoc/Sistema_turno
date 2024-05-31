@extends('layouts.app')

@section('page_css')
    <style>

    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Lista Catalogo Turnos</h3>
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
                                    data-target="#modal_add_catalogo_turno"><i class="fas fa-street-view"></i> Nuevo</a>
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
                                    <table class="table table-sm" id="tabla_vacacion" cellspacing="0"
                                        style="font-size: 80%;">
                                        <thead>
                                            <tr>
                                                <th class="col-1" style="text-align: center;"> No. </th>
                                                <th class="col-1" style="text-align: center;"> Nombre </th>
                                                <th class="col-2" style="text-align: center;"> Hora Inicio</th>
                                                <th class="col-2" style="text-align: center;"> Hora Fin</th>
                                                <th class="col-2" style="text-align: center;"> Descripcion</th>
                                                <th class="col-2" style="text-align: center;"> Fecha</th>
                                                <th class="col-2" style="text-align: center;"> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($catalogoturnos as $catalogoturno)
                                                <tr>
                                                    <td style="text-align: center;">
                                                        {{ $catalogoturno->id_catalogo_turno }}</td>
                                                    <td style="text-align: center;">{{ $catalogoturno->nombre }}</td>
                                                    <td style="text-align: center;">{{ $catalogoturno->inicio_hora }} </td>
                                                    <td style="text-align: center;">{{ $catalogoturno->fin_hora }} </td>
                                                    <td style="text-align: center;">{{ $catalogoturno->descripcion }} </td>
                                                    <td style="text-align: center;">{{ $catalogoturno->fn_catalogo_turno }}
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <a data-toggle="modal"
                                                            data-target="#modal_add_catalogo_editar_turno"
                                                            data-id="{{ $catalogoturno->id_catalogo_turno }}"
                                                            data-nombre="{{ $catalogoturno->nombre }}"
                                                            data-inicio_hora="{{ $catalogoturno->inicio_hora }}"
                                                            data-fin_hora="{{ $catalogoturno->fin_hora }}"
                                                            data-descripcion="{{ $catalogoturno->descripcion }}"
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
    <div class="modal fade" id="modal_add_catalogo_turno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Turno</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nombre_turno">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Fecha Realizado">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Inicio:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="inicio_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Inicio">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Final:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="fin_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Fin">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Descripcion</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="descripcion_turno">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Fecha Realizado">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_turno').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_turno" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>





    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_catalogo_editar_turno" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Editar Turno</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_catalogo_turno">

                        <label for="fr_catalogo_nombre">Nombre</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="editar_nombre_turno">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Fecha Realizado">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Inicio:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="editar_incio_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Inicio">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Final:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="editar_fin_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Fin">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Descripcion</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="editar_descripcion_turno">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Fecha Realizado">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_editar_turno').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_catalogo_editar_turno" class="btn btn-success btn-lg"><i
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

        $("#btn_guardar_catalogo_turno").click(function(e) {
            e.preventDefault();
            var nombre_turno = $("#nombre_turno").val();
            var inicio_hora = $("#inicio_hora").val();
            var fin_hora = $("#fin_hora").val();
            var descripcion_turno = $("#descripcion_turno").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_turno') }}",
                data: {
                    nombre_turno: nombre_turno,
                    inicio_hora: inicio_hora,
                    fin_hora: fin_hora,
                    descripcion_turno: descripcion_turno,
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
                var inicio_hora = $(this).data('inicio_hora');
                var fin_hora = $(this).data('fin_hora');
                var descripcion = $(this).data('descripcion');

                $('#id_catalogo_turno').val(id);
                $('#editar_nombre_turno').val(nombre);
                $('#editar_incio_hora').val(inicio_hora);
                $('#editar_fin_hora').val(fin_hora);
                $('#editar_descripcion_turno').val(descripcion);

            });
        });


        $("#btn_catalogo_editar_turno").click(function(e) {
            e.preventDefault();
            var id_catalogo_turno = $("#id_catalogo_turno").val();
            var editar_nombre_turno = $("#editar_nombre_turno").val();
            var editar_incio_hora = $("#editar_incio_hora").val();
            var editar_fin_hora = $("#editar_fin_hora").val();
            var editar_descripcion_turno = $("#editar_descripcion_turno").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_turno_editado') }}",
                data: {
                    id_catalogo_turno: id_catalogo_turno,
                    editar_nombre_turno: editar_nombre_turno,
                    editar_incio_hora: editar_incio_hora,
                    editar_fin_hora: editar_fin_hora,
                    editar_descripcion_turno: editar_descripcion_turno,
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
