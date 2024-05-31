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
                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary" href="{{ route('index_dependencia') }}"><i
                                        class="fas fa-layer-group"></i>Catalogos
                                    Dependencia</a>
                                <a class="btn btn-primary" href="{{ route('index_turno') }}"><i
                                        class="fas fa-layer-group"></i></i>Catalogo
                                    Turno</a>
                                <a class="btn btn-primary" href="/index_catalogo_roles"><i
                                        class="fas fa-layer-group"></i>Catalogo
                                    roles</a>
                                <a class="btn btn-primary " id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a href="#" class="btn btn-primary"><i class="fas fa-layer-group"></i> Detalle</a>
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
                                <img class="navbar-brand-full app-header-logo" src="{{ secure_asset('img/config.jpg') }}"
                                    width="150" alt="Infyom Logo">
                                <a href="{{ url('/') }}"></a>
                            </div>
                            <h4 style="text-align: center;">Bienvenido Módulo de catálogos</h4>
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
