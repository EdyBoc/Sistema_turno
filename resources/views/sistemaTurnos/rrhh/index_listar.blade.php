@extends('layouts.app')
@section('page_css')
    <style>
        .table thead th {
            background-color: #6b6e86;
            color: rgb(255, 255, 255);
            /* Color de fondo azul claro */
        }

        /* Estilo para la tabla */
        .table {
            border-collapse: separate;
            width: 100%;
            border-radius: 10px;
            /* Borde redondeado para la tabla */
            overflow: hidden;
            /* Para que los bordes redondeados se vean correctamente */
        }

        /* Estilo para las celdas de la tabla */
        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 10px;
            /* Ajuste el espaciado de las celdas aquí */
        }

        /* Estilo para las filas impares */
        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
            color: black;
        }

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
            <h4 class="page__heading">Recursos Humanos</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-primary btn-lg" href="{{ route('index_alta') }}">
                                    <i class="fas fa-street-view"></i> Nueva Alta
                                </a>
                                <a class="btn btn-primary btn-lg" href="{{ route('index_alta') }}">
                                    <i class="fas fa-street-view"></i> Lista personas
                                </a>
                                <a class="btn btn-primary btn-lg" href="{{ route('index_vacaciones') }}">
                                    <i class="fas fa-street-view"></i> Vacaciones
                                </a>
                                <a class="btn btn-primary btn-lg" href="{{ route('index_solicitudes') }}">
                                    <i class="fas fa-street-view"></i> Solicitudes
                                </a>

                                <a class="btn btn-primary btn-lg">
                                    <i class="fas fa-street-view"></i> Horas Extras
                                </a>

                                <a href="#" class="notification-icon">
                                    <i class="fas fa-bell" style="font-size: 23px;"></i>
                                    @if ($totalReporteHoras > 0)
                                        <span class="badge"
                                            title="Autorizacion de horas Pendientes">{{ $totalReporteHoras }}</span>
                                    @endif
                                </a>
                                <a href="#" class="notification-icon">
                                    <i class="fas fa-bell" style="font-size: 23px;"></i>
                                    @if ($totalSolicitudes > 0)
                                        <span class="badge"
                                            title="Autorizacion de horas Pendientes">{{ $totalSolicitudes }}</span>
                                    @endif
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
