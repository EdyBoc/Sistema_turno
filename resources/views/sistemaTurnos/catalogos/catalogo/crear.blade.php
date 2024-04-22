@extends('layouts.app')

@section('page_css')
<style>
.dropdown-menu {
    min-width: auto;
    width: auto; 
}

.select-rounded {
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>
@endsection

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Catalogos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-0 " >
                                <a class="btn btn-danger btn-lg" href="/lista_catalogo"><i class="fas fa-reply"></i></i>Regrar</a> 
                                <a class="btn btn-warning btn-lg" data-toggle="modal"
                                data-target="#modal_add_items" ><i class="fas fa-street-view" ></i> Nuevo</a> 
                            </div>  
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
                                <th style="text-align: center;"> Descripción </th>
                                <th style="text-align: center;"> Estado </th>
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

<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_items" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title" id="myModalLabel">Items | nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="catalogo_item">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                        <a id="btnCerrar" onclick="$('#modal_add_items').modal('hide');" class="btn btn-danger btn-lg"><i
                                class="fa fa-times"></i>&nbsp;Cancelar</a>
                        &nbsp;
                        <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg"><i
                            class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>

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


        $(document).ready(function() {
            $('#modal_add_editar').modal('hide');
        });

        function modalEditarCatalogo(id_catalogo) {
            $('#modal_add_editar_catalogo').modal('show');

            var id_catalogo = id_catalogo;
            $('#id_catalogo_editar').val(id_catalogo);
            // Actualiza la tabla
           
        }


</script>
@endsection