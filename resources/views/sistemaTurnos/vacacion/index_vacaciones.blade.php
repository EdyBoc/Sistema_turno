@extends('layouts.app')

@section('page_css')
    <style>
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Lista Autorizaciones Personal</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_listar') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>

                                <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> No. </th>
                                            <th class="col-2" style="text-align: center;"> Nombre</th>
                                            <th class="col-1" style="text-align: center;"> Tipo Permiso</th>
                                            <th class="col-2" style="text-align: center;"> Fecha/Hora Autorizacion</th>
                                            <th class="col-1" style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vw_usuario_autorizados as $vw_usuario_autorizado)
                                            <tr>
                                                <td style="text-align: center;">
                                                    {{ $vw_usuario_autorizado->id }}</td>
                                                <td style="text-align: center;">
                                                    {{ $vw_usuario_autorizado->nombre_completo }}</td>
                                                <td style="text-align: center;">{{ $vw_usuario_autorizado->tipo_solicitud }}
                                                </td>
                                                <td style="text-align: center;">
                                                    {{ $vw_usuario_autorizado->fecha_autorizacion }}
                                                <td style="text-align: center;">
                                                    <a href="{{ route('crear_vacaciones', ['id' => $vw_usuario_autorizado->id]) }}"
                                                        class="btn text-center" title="Autorizar"> <i
                                                            class="fas fa-user-cog text-primary"></i></a>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> No. </th>
                                            <th class="col-2" style="text-align: center;"> Nombre</th>
                                            <th class="col-1" style="text-align: center;"> Estado</th>
                                            <th class="col-1" style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vw_usuario_autorizados as $vw_usuario_autorizado)
                                            <tr>
                                                <td style="text-align: center;">
                                                    {{ $vw_usuario_autorizado->id }}</td>
                                                <td style="text-align: center;">
                                                    {{ $vw_usuario_autorizado->nombre_completo }}</td>
                                                <td style="text-align: center;">{{ $vw_usuario_autorizado->tipo_solicitud }}
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('crear_vacaciones', ['id' => $vw_usuario_autorizado->id]) }}"
                                                        class="btn text-center" title="Autorizar"> <i
                                                            class="fas fa-user-cog text-primary"></i></a>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
