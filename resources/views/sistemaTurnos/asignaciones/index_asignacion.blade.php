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
                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary"><i class="fas fa-business-time"></i>Dependencia</a>
                                <a class="btn btn-primary"><i class="fas fa-business-time"></i></i>Turno</a>
                                <a class="btn btn-primary " href="{{ route('index_usuario') }}"><i
                                        class="fas fa-user-lock"></i>
                                    Asignar Rol</a>
                                <a class="btn btn-primary " id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
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
                            <h4 style="text-align: center;">Bienvenido al Módulo de asignaciones</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
