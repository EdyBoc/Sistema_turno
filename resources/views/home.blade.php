@extends('layouts.app')
@section('page_css')
    <style>
        /* HTML: <div class="loader"></div> */
        .loader {
            width: 50px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #25b09b;
            --_m:
                conic-gradient(#0000 10%, #000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
            mask: var(--_m);
            -webkit-mask-composite: source-out;
            mask-composite: subtract;
            animation: l3 1s infinite linear;
        }

        @keyframes l3 {
            to {
                transform: rotate(1turn)
            }
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            @if ($rol_usuario == 'Administrador')
                <a class="nav-link" href="/index_catalogo">
                    <i class="fas fa-book"></i><span> Catálogo</span>
                </a>
                <a class="nav-link" href="/index_asignacion">
                    <i class="fas fa-clipboard-list"></i><span> Asignación</span>
                </a>
                <a class="nav-link" href="/index_listar">
                    <i class="fas fa-paperclip"></i><span> Recursos Humanos</span>
                </a>
                <a class="nav-link" href="/index_reporte">
                    <i class="fas fa-paperclip"></i><span> Repostería</span>
                </a>
            @elseif($rol_usuario == 'Coordinador')
                <a class="nav-link" href="/index_listar">
                    <i class="fas fa-paperclip"></i><span> Recursos Humanos</span>
                </a>
                <a class="nav-link" href="/index_reporte">
                    <i class="fas fa-paperclip"></i><span> Repostería</span>
                </a>
            @elseif($rol_usuario == 'Empleado')
                <a class="nav-link" href="/index_perfil">
                    <i class="fas fa-walking"></i><span> Gestion de Usuario</span>
                </a>
            @else
                <p>No tiene acceso a estas opciones</p>
            @endif

        </div>
        <div class="section-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="justify-content-center text-center">
                                    <h6 id="fecha" class="text-center"></h6>
                                    <h6 class="page__heading">Ingrese su codigo</h6>
                                </div>

                                <div class="input-group">
                                    <input type="password" class="form-control" id="codigo" name="codigo" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="togglePassword"
                                            data-toggle="tooltip" title="Mostrar/Ocultar contraseña">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary" id="btn_ingreso">
                                    <i class="fas fa-clock"></i> Ingreso</a>
                                <a class="btn btn-primary" id="btn_salida">
                                    <i class="fas fa-running"></i> Salida</a>
                            </div>
                            <br>
                            <div class="container d-flex justify-content-center align-items-center">
                                <div class="loader" id="loader"></div>
                            </div>
                            <h6 style="text-align: center;">Bienvenido al Sistema de Turnos</h6>
                            <div class="sidebar-brand" style="text-align: center;">
                                <img class="navbar-brand-full app-header-logo" src="{{ asset('img/config.jpg') }}"
                                    width="150" alt="Infyom Logo">
                                <a href="{{ url('/') }}"></a>
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
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('codigo');
            const icon = this.querySelector('i');
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        });

        setInterval(() => {
            let fecha = new Date();
            let fechaHora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechaHora;
        }, 1000);

        $(document).ready(function() {
            $('#loader').hide();
        });

        $("#btn_ingreso").click(function() {
            $('#loader').show();
            var URL = "{{ route('guardar_campos_entrada') }}";
            var token = '{{ csrf_token() }}';
            var data = {
                codigo: $('#codigo').val(),
            };

            $.ajax({
                url: URL,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    } else {
                        toastr.success(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    }
                }
            });
        });
        $("#btn_salida").click(function() {
            $('#loader').show();
            var URL = "{{ route('guardar_campos_salida') }}";
            var token = '{{ csrf_token() }}';
            var data = {
                codigo: $('#codigo').val(),
            };

            $.ajax({
                url: URL,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': token
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
    </script>
@endsection
