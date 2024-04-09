@extends('layouts.auth_app')
@section('title')
Publico
@endsection
@section('content')


<div class="card card-primary">
    <div class="card-header">
        <h4>Bienvenido al Sistema</h4>
    </div>

    <div class="card-body pt-1">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                        @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">lOGIN</a>

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
                    <input type="password" class="form-control" id="codigo" name="codigo" placeholder="Ingrese su codigo AQUI">
                </div>

                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
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

<script>
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

    // Actualizar cada segundo
    setInterval(mostrarHora, 1000);

    // Mostrar la hora inicial
    mostrarHora();
</script>

@endsection