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
                                <table class="table table-sm" id="tabla_personas" cellspacing="0" style="font-size: 80%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hr_Inicio</th>
                                            <th>Hr_Fin</th>
                                            <th>Cantidad</th>
                                            <th>Estado</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>14:00</td>
                                            <td>15:00</td>
                                            <td>100</td>
                                            <td>En curso</td>
                                            <td>-</td>
                                        </tr>
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
                        <label for="fr_catalogo_nombre">Fecha realizado:</label>
                        <div class="input-group">
                            <input type="date" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Inicio:</label>
                        <div class="input-group">
                            <input type="time" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Hora Final:</label>
                        <div class="input-group">
                            <input type="time" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <label for="fr_catalogo_nombre">Motivo:</label>
                    <textarea class="form-control form-control-lg" id="catalogo_nombre" rows="10"></textarea>

                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_horas').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
