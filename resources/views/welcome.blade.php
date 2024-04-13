@extends('layouts.auth_app')
@section('title')
Publico
@endsection

@section('styles')
<style>
 .loader {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  border: 3px solid;
  border-color: #FFF #FFF transparent transparent;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 3px solid;
  border-color: transparent transparent #FF3D00 #FF3D00;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-sizing: border-box;
  animation: rotationBack 0.5s linear infinite;
  transform-origin: center center;
}
.loader::before {
  width: 32px;
  height: 32px;
  border-color: #FFF #FFF transparent transparent;
  animation: rotation 1.5s linear infinite;
}
    
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
@keyframes rotationBack {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}

      
</style>
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h4>Bienvenido al Sistema</h4>
    </div>
    <div>

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
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">REGISTRARSE</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                    <h6 id="fecha" class="text-center"></h6>
                    <div class="container d-flex justify-content-center align-items-center">
                        <span class="loader" id="loader"></span>
                      </div>
                  
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
</script>
@endsection