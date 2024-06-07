@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Gestion de Usuario</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary btn-lg" href="{{ route('index_horas_extras') }}">
                                    <i class="fas fa-street-view"></i> Lista Horas Extras
                                </a>
                                <a class="btn btn-primary btn-lg" href="{{ route('index_solicitudes') }}">
                                    <i class="fas fa-street-view"></i> Lista Solicitudes
                                </a>
                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_gestion"><i
                                        class="fas fa-key"></i> Gestionar Mi clave</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="sidebar-brand" style="text-align: center;">
                                <img class="navbar-brand-full app-header-logo" src="{{ asset('img/config.jpg') }}"
                                    width="150" alt="Infyom Logo">
                                <a href="{{ url('/') }}"></a>
                            </div>
                            <h4 style="text-align: center;">Bienvenido Modulo Trabajador</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_gestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Gestor de Credenciales</h5>
                </div>
                <div class="modal-body">

                    <label for="fr_catalogo_nombre">Generar clave</label>

                    <div class="input-group">
                        <input type="password" class="form-control" id="id_credencial" name="id_credencial" required>
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" id="togglePassword" data-toggle="tooltip"
                                title="Mostrar/Ocultar contraseña">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_gestion').modal('hide');" class="btn btn-danger"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_credencial" class="btn btn-warning"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#btn_guardar_credencial").click(function(e) {
            e.preventDefault();
            var id_credencial = $("#id_credencial").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_credenciales') }}",
                data: {
                    id_credencial: id_credencial
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                        location.reload();
                    } else {
                        toastr.success(response.message);
                        //$("#id_credencial").val(response.clave);
                        location.reload();
                    }
                }
            });
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('id_credencial');
            const icon = this.querySelector('i');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        });
    </script>
@endsection
