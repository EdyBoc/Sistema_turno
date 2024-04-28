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
                                    <thead style="background-color:#6777ef">
                                        <th style="display: none;">ID</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">E-mail</th>
                                        <th style="color:#fff;">Rol</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </thead>
                                </table>

                                <a class="btn btn-warning" href="">Nuevo</a>

                                <!-- Centramos la paginacion a la derecha -->
                                <div class="pagination justify-content-end">
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
                url: "{{ route('listar') }}",
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
