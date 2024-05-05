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
</style>
@endsection

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
                            <i class="fas fa-street-view">Nuevo</i>
                        </a>
                        <a class="btn btn-primary  btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                            Actualizar</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-10 table-responsive">
                            <table class="table table-sm" id="tabla_vacacion" cellspacing="0" style="font-size: 80%;">
                                <thead>
                                    <tr>
                                        <th> No. </th>
                                        <th> fecha inicio</th>
                                        <th> fecha final</th>
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacaciones as $vacacion)
                                    <tr>
                                        <td>{{ $vacacion->id_vacacion }}</td>
                                        <td>{{ $vacacion->fn_inicio }}</td>
                                        <td>{{ $vacacion->fn_fin }}</td>
                                        <td>
                                            <a class="btn-primary btn-sm" id="ver_detalle"><i class="far fa-eye"></i></a>
                                            <a class="btn-primary btn-sm" id="editar_vacacion" href="{{ route('crear_vacaciones', ['id_vacacion' => $vacacion['id_vacacion']]) }}"><i class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="detalles" style="display: none;">
                                        <td colspan="2">
                                            <span>Días Gozados: {{ $vacacion->dias_gozados }}</span><br>
                                            <span>Días Rezagados: {{ $vacacion->dias_rezagados }}</span><br>
                                            <span>Estado: {{ $vacacion->estado }}</span><br>
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

        $("#ver_detalle").click(function() {
            var detallesRow = $(this).parent().parent().next();
            detallesRow.toggle();
        });
    });
</script>
@endsection