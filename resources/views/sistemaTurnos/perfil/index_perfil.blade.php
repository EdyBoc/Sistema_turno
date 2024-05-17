@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Perfil</h4>
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
@endsection
