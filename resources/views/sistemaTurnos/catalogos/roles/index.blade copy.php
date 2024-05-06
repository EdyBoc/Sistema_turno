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
    </style>
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Listado Catalogos Rol</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <a class="btn btn-danger btn-lg" href="/index_catalogo"><i
                                            class="fas fa-reply"></i>Regrar</a>
                                    <a class="btn btn-primary btn-lg" id="btn_actualizar"><i class="fas fa-history"></i>
                                        Actualizar</a>

                                    <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add_items"><i
                                            class="fas fa-street-view"></i> Crear Catalogo
                                        Items</a>
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
                                <div class="container d-flex justify-content-center align-items-center">
                                    <div class="loader" id="loader"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm" id="listadoTabla" cellspacing="0" style="font-size: 80%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nombre</th>
                                                <th> Descripción </th>
                                                <th>Fecha</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Aquí se generarán dinámicamente las filas de la tabla -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal_add_items" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Nuevo Catálogo</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="catalogo_nombre">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_items').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add_catalogo_rol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white  text-center">
                    <h5 class="modal-title  mx-auto">Editar Catálogo</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="catalogo_nombre_editar">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre Catalogo">
                                    <i class="fas fa-puzzle-piece"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_editar').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_editar" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
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

        $(document).ready(function() {
            cargarDatos();
        });

        //CARGA DE DATOS EN LA LISTA
        function cargarDatos() {
            var tabla = document.getElementById('listadoTabla');
            $.ajax({
                url: "{{ route('listar_catalogo_rol') }}",
                type: 'POST',
                success: function(response) {
                    if (response.mensaje) {
                        toastr.error(response.mensaje);
                    } else {
                        generarTabla(response);
                    }
                },
                error: function(xhr, status, error) {}
            });
        }

        function generarTabla(response) {
            var tabla = $('#listadoTabla tbody');
            tabla.empty(); //Limpiar la tabla antes de agregar
            var contador = 1;
            // Itera sobre los datos en la respuesta
            response.forEach(function(item) {
                // Crea una nueva fila de tabla
                var fila = $('<tr>');
                // Agrega celdas con los datos del ítem
                fila.append($('<td>').text(contador));
                fila.append($('<td>').text(item.nombre));
                fila.append($('<td>').text(item.descripcion));
                fila.append($('<td>').text(item.fn_catalogo_rol));
                fila.append($('<td align=center>').html(
                    '<a title="Editar" data-toggle="tooltip" href="#" onclick="modalEditarRol(' + item
                    .id_catalogo_rol + ', \'' + item.nombre + '\')">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>'
                ));
                // Agrega la fila a la tabla
                tabla.append(fila);
                contador++;
            });
        }

        function modalEditarRol(id_catalogo_rol, nombre) {
            console.log("Opción id_catalogo_items:", id_catalogo_rol);
            console.log("Nombre:", nombre);
            $('#modal_add_catalogo_rol').modal('show');
            var id_catalogo_item = id_catalogo_rol;
            var nombre = nombre;
            $('#id_catalogo_items').val(id_catalogo_item);
            $('#nombre_catalogo_items').val(nombre);
        }
    </script>
@endsection
