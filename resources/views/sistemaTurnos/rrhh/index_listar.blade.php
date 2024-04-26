@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Modulo Recursos Humanos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="justify-content-center text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-lg"> <i class="fas fa-street-view" >Nuevo</i></button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item " href=" "><i class="fas fa-street-view"></i> Nueva Alta</a> 
                                    <a class="dropdown-item " href=" "><i class="fas fa-business-time"></i> Nueva baja</a>
                                </div>
                            </div>
                            <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i> Actualizar</a>
                            <a class="btn btn-danger  btn-lg" id=""><i class="far fa-file-pdf"></i> PDF</a>
                        </div>                    
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
                                <th style="text-align: center;"> telefono </th>
                                <th style="text-align: center;"> correo electronico</th>
                                <th style="text-align: center;"> fecha ingreso</th>
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