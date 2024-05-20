@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Autorizacion horas</h3>
        </div>
        <div class="section-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger " href="{{ route('index_autorizacion') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary " id="btn_actualizar"><i class="fas fa-history"></i>
                                    Actualizar</a>
                                <a class="btn btn-primary" id="btn_actualizar"><i class="fas fa-search"></i>
                                    Buscar</a>
                                <div class="row">
                                    <div class=" col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleSelect">Selecciona Usuario:</label>
                                            {{ Form::select('usuarios', @$usuarios, null, ['id' => 'id_usuario', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}
                                        </div>
                                    </div>
                                    <div class=" col-lg-6">
                                        <div class="form-group">
                                            <label for="comentario">Fecha:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="comentario" name="comentario"
                                                    required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" data-toggle="tooltip"
                                                        title="Comentario">
                                                        <i class="fas fa-puzzle-piece"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-sm" id="tabla_vacacion" cellspacing="0"
                                        style="font-size: 80%;">
                                        <thead>
                                            <tr>
                                                <th class="col-1" style="text-align: center;"> No. </th>
                                                <th class="col-2" style="text-align: center;"> Usuario</th>
                                                <th class="col-2" style="text-align: center;"> Cant. horas</th>
                                                <th class="col-2" style="text-align: center;"> Fecha</th>
                                                <th class="col-2" style="text-align: center;"> Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reportehoras as $reportehora)
                                                <tr>
                                                    <td style="text-align: center;">{{ $reportehora->id_reporte_horas }}
                                                    </td>
                                                    <td style="text-align: center;">{{ $reportehora->user }}</td>
                                                    <td style="text-align: center;">{{ $reportehora->inicio_hora }}</td>
                                                    <td style="text-align: center;">{{ $reportehora->fecha_reporte_horas }}
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a class="btn btn-primary btn-sm text-center"
                                                            title="Anular solicitud">
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

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="justify-content-center text-center">
                                        <a class="btn btn-primary" id="btn_actualizar"><i class="fas fa-search"></i>
                                            Buscar</a>
                                        <div class="row">
                                            <div class=" col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleSelect">Selecciona Usuario:</label>
                                                    {{ Form::select('usuarios', @$usuarios, null, ['id' => 'id_usuario', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}
                                                </div>
                                            </div>
                                            <div class=" col-lg-6">
                                                <div class="form-group">
                                                    <label for="comentario">Fecha:</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="comentario"
                                                            name="comentario" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" data-toggle="tooltip"
                                                                title="Comentario">
                                                                <i class="fas fa-puzzle-piece"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-sm" id="tabla_vacacion" cellspacing="0"
                                                style="font-size: 80%;">
                                                <thead>
                                                    <tr>
                                                        <th class="col-1" style="text-align: center;"> No. </th>
                                                        <th class="col-2" style="text-align: center;"> Inicio</th>
                                                        <th class="col-2" style="text-align: center;"> Fin</th>
                                                        <th class="col-2" style="text-align: center;"> Total</th>
                                                        <th class="col-2" style="text-align: center;"> Fecha</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
