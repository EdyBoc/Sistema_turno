@extends('layouts.app')

@section('styles')
    <style>
        /* Tus estilos CSS aquí */
    </style>
@endsection
@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Modulo de Asignaciones</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Example split danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning">Nuevo</button>
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item " href=" "><i class="fas fa-street-view"></i> Asignar Dependencia</a> 
                                <a class="dropdown-item " href=" "><i class="fas fa-business-time"></i> Asignar Turno</a>
                                <a class="dropdown-item " href=" "><i class="fas fa-user-lock"></i> Asignar Rol</a>
                            </div>
                        </div>
                        <a class="btn btn-success" id="btn_actualizar"><i class="fas fa-history"></i>Actualizar</a>
                        <a href="#" class="btn btn-primary" id="btn_detalle"><i class="fas fa-layer-group"></i>Detalle</a>
                        <a class="btn btn-secondary" href=" "><i class="fas fa-plus-circle"></i> modelo de boton</a>  
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                  <p class="card-text">Bienvenido al modulo de asignaciones</p>
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