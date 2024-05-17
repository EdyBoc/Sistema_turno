@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Lista Personas</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_listar') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>

                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_solicitud"><i
                                        class="fas fa-street-view"></i> Nuevo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th class="col-1" style="text-align: center;"> No. </th>
                                            <th class="col-2" style="text-align: center;"> cui</th>
                                            <th class="col-2" style="text-align: center;"> Nombre nompleto</th>
                                            <th class="col-2" style="text-align: center;"> Telefono</th>
                                            <th class="col-2" style="text-align: center;"> Estado</th>
                                            <th class="col-2" style="text-align: center;"> Fecha Contratado</th>
                                            <th style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personas as $persona)
                                            <tr>
                                                <td style="text-align: center;">{{ $persona->id_persona }}</td>
                                                <td style="text-align: center;">{{ $persona->cui }}</td>
                                                <td style="text-align: center;">{{ $persona->nombre_completo }}</td>
                                                <td style="text-align: center;">{{ $persona->telefono }}</td>
                                                <td style="text-align: center;">{{ $persona->estado }}</td>
                                                <td style="text-align: center;">{{ $persona->fh_contratado }}</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-primary btn-sm text-center" title="Anular solicitud">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
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
    <script></script>
@endsection
