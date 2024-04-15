@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Módulo de catálogos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="/dependencia"><i class="fas fa-street-view"></i> Nueva dependencia</a> 
                        <a class="btn btn-warning" href=" "><i class="fas fa-business-time"></i> Nuevo turno</a>
                        <a class="btn btn-warning" href="/roles"><i class=" fas fa-user-lock"></i> Nuevo rol</a>
                        <a class="btn btn-success" id="btn_actualizar"><i class="fas fa-history"></i> Actualizar</a>
                        <a href="#" class="btn btn-primary"><i class="fas fa-layer-group"></i> Detalle</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                  <p class="card-text">Bienvenido al Módulo de catálogos</p>
                  <div class="sidebar-brand">
                    <img class="navbar-brand-full app-header-logo" src="{{ asset('img/config.jpg') }}" width="75"
                        alt="Infyom Logo">
                    <a href="{{ url('/') }}"></a>
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

    $(document).ready(function() {
        $("#btn_actualizar").click(function() {
        location.reload();
    });
    });

</script>
@endsection