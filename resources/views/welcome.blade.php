@extends('layouts.auth_app')
@section('title')
Publico
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h4>Bienvenido al Sistema</h4>
    </div>
    <div>

    </div>
    <input type="text" id="token" name="_token" value="{{ csrf_token() }}">
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
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">REGISTRARSE</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                    <div id="clock" class="text-center"></div>
                </div>
                <div class="form-group">
                    <label for="lb_codigo">CODIGO</label>
                    <input type="password" class="form-control" id="codigo" name="codigo" placeholder="Ingrese su codigo">
                </div>

                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <button type=" " id="btn_ingreso" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                ENTRADA
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                SALIDA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-1.12.0.min.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>



<script type="text/javascript">
    function mostrarHora() {
        var fecha = new Date();
        var horas = fecha.getHours();
        var minutos = fecha.getMinutes();
        var segundos = fecha.getSeconds();

        // Formatear a dos dígitos si es necesario
        horas = horas < 10 ? '0' + horas : horas;
        minutos = minutos < 10 ? '0' + minutos : minutos;
        segundos = segundos < 10 ? '0' + segundos : segundos;

        var horaActual = horas + ':' + minutos + ':' + segundos;

        document.getElementById('clock').innerHTML = horaActual;
    }
    setInterval(mostrarHora, 1000);
    mostrarHora();

    $("#btn_ingreso").click(function() {
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
                if (response.status != 200) {
                    toastr.error(response.mensaje);
                } else {
                    toastr.success(response.mensaje);
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