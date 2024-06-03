@extends('layouts.auth_app')
@section('title')
    Register
@endsection
@section('content')
    <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_catalogo_dependencia"><i
            class="fas fa-street-view"></i>
        Nuevo</a>

    <div class="modal fade" id="modal_add_catalogo_dependencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Dependencia</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nombre_dependencia">
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
                            <input type="text" class="form-control" id="descripcion_dependencia">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="descripcion_dependencia">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_dependencia').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_dependencia" class="btn btn-success btn-lg"><i
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

        $("#btn_guardar_catalogo_dependencia").click(function(e) {
            e.preventDefault();
            var nombre_dependencia = $("#nombre_dependencia").val();
            var descripcion_dependencia = $("#descripcion_dependencia").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_dependencia') }}",
                data: {
                    nombre_dependencia: nombre_dependencia,
                    descripcion_dependencia: descripcion_dependencia,
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
