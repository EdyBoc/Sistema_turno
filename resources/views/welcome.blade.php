@extends('layouts.auth_app')
@section('title')
    Publico
@endsection

@section('styles')
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

    <div class="card card-primary">
        <div class="card-header">
            <h4>Bienvenido al Sistema</h4>
        </div>
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <div class="card-body pt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">INICIAR SESION</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 underline">REGISTRARSE</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                        <h6 id="fecha" class="text-center"></h6>
                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="loader" id="loader"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="lb_codigo">CODIGO</label>
                        <input type="password" class="form-control" id="codigo" name="codigo"
                            placeholder="Ingrese su codigo">
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <button type=" " id="btn_ingreso" class="btn btn-primary btn-block"
                                    tabindex="4">ENTRADA</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-center">
                                <button type="" id="btn_salida" class="btn btn-primary btn-block"
                                    tabindex="4">SALIDA</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
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
            var URL = "{{ route('guardar_campos_requerimiento') }}";
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
                    if (!response.success) { // Verifica si el campo "success" es falso
                        toastr.error(response.message);
                        $('#loader').hide();

                    } else {
                        toastr.success(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Error en la solicitud AJAX: " + error);
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
                    if (!response.success) { // Verifica si el campo "success" es falso
                        toastr.error(response.message);
                        $('#loader').hide();

                    } else {
                        toastr.success(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Error en la solicitud AJAX: " + error);
                }
            });
        });
    </script>
@endsection
