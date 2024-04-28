@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
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
                                        <th style="text-align: center;"> Email </th>
                                        <th style="text-align: center;"> Rol </th>
                                         <th style="text-align: center;"> Estado </th>
                                        <th style="text-align: center;" width="60"> Acciones</th>
                                    </thead>
                                </table>
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

        $('#avanzado').on('change keyup', function(e) {
            var keyCode = e.keyCode || e.which;
            if ((keyCode == 13)) {
                $('#listadoTabla').DataTable().ajax.reload();
            }
        });

        //busqueda por filtros
        $("#btnBuscar").click(function() {
            event.preventDefault();
            $('#listadoTabla').DataTable().ajax.reload();
        });

        //CARGA DE DATOS EN LA LISTA
        $('#listadoTabla').DataTable({
            columnDefs: [{
                className: "dt-body-center",
                orderable: false,
                targets: "_all"
            }],
            order: [0, 'desc'],
            bFilter: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('listar_usuarios') }}",
                type: 'POST',
                data: function(d) {
                    d.avanzado = $("#avanzado").val();
                    d.estado = $("#estado").val();
                }
            }
        });
        $.fn.dataTable.ext.errMode = 'throw';
    </script>
@endsection
