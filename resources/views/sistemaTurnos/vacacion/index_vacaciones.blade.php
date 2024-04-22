@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Lista Vacaciones</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-primary btn-lg" href="{{ route('crear_vacaciones') }}">
                            <i class="fas fa-street-view" >Nuevo</i>
                        </a>
                        <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i> Actualizar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <table class="table table-bordered table-striped" id="listadoTabla" cellspacing="0"
                            style="font-size: 12px;">
                            <thead>
                                <th style="text-align: center;"> No. </th>
                                <th style="text-align: center;"> Nombre </th>
                                <th style="text-align: center;"> Periodo de Vacaciones</th>
                                <th style="text-align: center;"> fh inicio</th>
                                <th style="text-align: center;"> fh fin</th>
                                <th style="text-align: center;"> dias gozados</th>
                                <th style="text-align: center;"> dias rezagados</th>
                                <th style="text-align: center;"> estado</th>
                                <th style="text-align: center;" width="60"> Acciones</th>
                            </thead>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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