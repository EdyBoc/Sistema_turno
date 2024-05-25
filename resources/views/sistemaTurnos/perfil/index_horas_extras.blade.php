@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h4 class="page__heading">Lista Mis Horas Extras</h4>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_perfil') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_horas"><i
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
                                            <th class="col-2" style="text-align: center;"> Hora Inicio</th>
                                            <th class="col-2" style="text-align: center;"> Hora Fin</th>
                                            <th class="col-2" style="text-align: center;"> Fecha</th>
                                            <th class="col-2" style="text-align: center;"> Estado</th>
                                            <th style="text-align: center;"> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reportehoras as $index => $reportehora)
                                            <tr>
                                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                                <td style="text-align: center;">{{ $reportehora->inicio_hora }}</td>
                                                <td style="text-align: center;">{{ $reportehora->fin_hora }}</td>
                                                <td style="text-align: center;">{{ $reportehora->fecha_reporte_horas }}</td>
                                                <td
                                                    style="text-align: center; color:
                                                @if ($reportehora->estado === 'Autorizado') green;
                                                @elseif ($reportehora->estado === 'No autorizado')
                                                    blue;
                                                @else
                                                    red; @endif
                                                ">
                                                    <strong>{{ $reportehora->estado }}</strong>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="#" class="btn text-center anular-solicitud"
                                                        data-id="{{ $reportehora->id_reporte_horas }}"
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
        </div>
    </section>

    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_horas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Catálogo</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Inicio:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="inicio_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Inicio">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Final:</label>
                        <div class="input-group">
                            <input type="time" class="form-control" id="fin_hora">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Hora Fin">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Fecha realizado:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fecha_reporte_horas">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Fecha Realizado">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_horas').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_horas" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#btn_guardar_horas").click(function(e) {
            e.preventDefault();
            var inicio_hora = $("#inicio_hora").val();
            var fin_hora = $("#fin_hora").val();
            var fecha_reporte_horas = $("#fecha_reporte_horas").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_horas') }}",
                data: {
                    inicio_hora: inicio_hora,
                    fin_hora: fin_hora,
                    fecha_reporte_horas: fecha_reporte_horas
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                    }
                }
            });
        });

        $(document).ready(function() {
            $(".anular-solicitud").click(function(e) {
                e.preventDefault();
                var id_reporte_horas = $(this).data('id');
                anularSolicitud(id_reporte_horas);
            });
        });

        function anularSolicitud(id_reporte_horas) {
            $.ajax({
                type: "POST",
                url: "{{ route('anular_solicitud_horas') }}",
                data: {
                    id_reporte_horas: id_reporte_horas,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
