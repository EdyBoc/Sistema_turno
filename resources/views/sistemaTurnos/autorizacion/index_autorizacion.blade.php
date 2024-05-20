@extends('layouts.app')
@section('page_css')
    <style>
        /* Estilo para la fila de detalles */
        .detalles {
            background-color: #ffffff;
            /* Color de fondo */
            border-radius: 10px;
            /* Borde redondeado para la fila de detalles */
        }

        .notification-icon {
            position: relative;
            display: inline-block;
        }

        .notification-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 3px 6px;
            font-size: 12px;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Modulo de Autorizacion</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary btn-lg">
                                    <i class="fas fa-street-view"></i> Vacaciones
                                </a>
                                <a class="btn btn-primary btn-lg">
                                    <i class="fas fa-street-view"></i> Solicitudes
                                </a>

                                <a class="btn btn-primary btn-lg">
                                    <i class="fas fa-street-view"></i> Horas Extras
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
                            <h4 style="text-align: center;">Bienvenido</h4>
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
