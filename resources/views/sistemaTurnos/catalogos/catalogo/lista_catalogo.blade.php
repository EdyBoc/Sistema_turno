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

        .loader {
            width: 50px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #25b09b;
            --_m:
                conic-gradient(#0000 10%, #000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
            mask: var(--_m);
            -webkit-mask-composite: source-out;
            mask-composite: subtract;
            animation: l3 1s infinite linear;
        }

        @keyframes l3 {
            to {
                transform: rotate(1turn)
            }
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
            <h3 class="page__heading">Listado Catalogos Items</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <a class="btn btn-danger btn-lg" href="/index_catalogo"><i
                                                class="fas fa-reply"></i></i>Regrar</a>
                                        <a class="btn btn-primary btn-lg" data-toggle="modal"
                                            data-target="#modal_add_catalogo"><i class="fas fa-street-view"></i> Nuevo
                                            Catalogo</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="input-group">
                                        {{ Form::select('catalogo', @$catalogo, null, ['id' => 'id_catalogo', 'class' => 'form-control ', 'placeholder' => 'Seleccione...']) }}
                                        <a id="btn_editar_catalogo" class="btn btn-primary" type="button" title="Buscar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <a id="btn_creacion_catalogo" class="btn btn-primary btn-lg" data-toggle="modal"
                                        data-target="#modal_add_catalogo_items"><i class="fas fa-street-view"></i> Crear
                                        Catalogo
                                        hijo</a>

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
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
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

    <!-- Modal nuevo Catalogo-->
    <div class="modal fade" id="modal_add_catalogo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo').modal('hide');" class="btn btn-danger btn-lg"><i
                            class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal editar Catalogo-->
    <div class="modal fade" id="modal_add_catalogo_editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

    <!-- Modal nuevo Catalogo items-->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_catalogo_items" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Catalgo Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fr_nombre_catalogo_editar">Catalogo:</label>
                        <input type="text" class="form-control" id="nombre_catalogo_editar" readonly>
                    </div>

                    <div class="form-group">
                        <label for="fr_catalogo_nombre">Nombre:</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" data-toggle="tooltip" title="Nombre">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <a id="btnCerrar" onclick="$('#modal_add_catalogo_items').modal('hide');"
                        class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
                    &nbsp;
                    <a href="#" id="btn_guardar_catalogo_items" class="btn btn-success btn-lg"><i
                            class="fas fa-save"></i>&nbsp;Guardar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal editar Catalogo items-->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal_add_editar_catalogo_item"
        tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary text-white">
                    <h5 class="modal-title" id="myModalLabel">Cagaloto Items | Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <input type="hidden" class="form-control" id="id_catalogo_items">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre_catalogo_items">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a id="btnCerrar" onclick="$('#modal_add_editar_catalogo_item').modal('hide');"
                            class="btn btn-danger btn-lg"><i class="fa fa-times"></i>&nbsp;Cancelar</a>
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
        $(document).ready(function() {
            $("#btn_actualizar").click(function() {
                location.reload();
            });
        });

        $(document).ready(function() {
            $('#modal_add_editar').modal('hide');
            $('#loader').hide();
            $('#btn_creacion_catalogo').hide();
            $('#btn_editar_catalogo').hide();
        });


        $("#btn_guardar_catalogo").click(function(e) {
            e.preventDefault();
            var nombre = $("#catalogo_nombre").val();
            $.ajax({
                type: "POST",
                url: "{{ route('guardar_catalogo') }}",
                data: {
                    nombre: nombre
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                        $('#loader').hide();

                    } else {
                        toastr.success(response.message);
                        $('#loader').hide();
                        window.location.reload();

                    }
                }
            });
        });


        $("#id_catalogo").on("change", function() {
            var opcionSeleccionada = $(this).val();
            //console.log("Opción seleccionada:", opcionSeleccionada);
            listaCatalogoItems(opcionSeleccionada);
            nuevaCatalogo_items(opcionSeleccionada);
        });

        $('#btn_editar_catalogo').click(function() {
            $('#modal_add_catalogo_editar').modal('show');
            var id_catalogo = $('#id_catalogo').val();
            var nombre = $('#id_catalogo option:selected').text();
            $('#id_catalogo_editar').val(id_catalogo);
            $('#catalogo_nombre_editar').val(nombre);
        });

        function nuevaCatalogo_items(id_catalogo) {
            if (id_catalogo) {
                $('#btn_creacion_catalogo').show();
                $('#btn_editar_catalogo').show();

            } else {
                $('#btn_creacion_catalogo').hide();
                $('#btn_editar_catalogo').hide();
            }
        }


        function listaCatalogoItems(id_catalogo) {
            var URL = "{{ route('listar_catalogo') }}";
            var token = '{{ csrf_token() }}';
            var data = {
                id_catalogo: id_catalogo
            };
            $('#loader').show();
            $.ajax({
                url: URL,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (response.mensaje) {
                        toastr.error(response.mensaje);
                        window.location.reload();
                        $('#loader').hide();

                    } else {
                        generarTabla(response);
                        $('#loader').hide();
                    }
                },
                error: function(response) {
                    toastr.error(response.mensaje);
                }
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
                fila.append($('<td>').text(item.fh_catalogo_items));
                fila.append($('<td>').text(item.estado));

                if (item.estado === 'activo') {
                    fila.append($('<td align=center>').html(
                        '<a title="Inactivar" data-toggle="tooltip" href="#" onclick="inactivarCatalogoItem(' +
                        item.id_catalogo_item + ')">' +
                        '<i class="fas fa-exclamation-circle"></i>' +
                        '</a>' +
                        '<a title="Editar" data-toggle="tooltip" href="#" onclick="modalEditarItems(' + item
                        .id_catalogo_item + ', \'' + item.nombre + '\')">' +
                        '<i class="fas fa-edit"></i>' +
                        '</a>'
                    ));
                } else {
                    fila.append($('<td align=center>').html(
                        '<a title="Activar" data-toggle="tooltip" href="#" onclick="inactivarCatalogoItem(' +
                        item.id_catalogo_item + ')">' +
                        '<i class="fas fa-check-circle"></i>' +
                        '</a>'
                    ));
                }

                // Agrega la fila a la tabla
                tabla.append(fila);
                contador++;
            });
        }

        function modalEditarItems(id_catalogo_item, nombre) {
            console.log("Opción id_catalogo_items:", id_catalogo_item);
            console.log("Nombre:", nombre);
            $('#modal_add_editar_catalogo_item').modal('show');
            var id_catalogo_item = id_catalogo_item;
            var nombre = nombre;
            $('#id_catalogo_items').val(id_catalogo_item);
            $('#nombre_catalogo_items').val(nombre);
        }


        function inactivarCatalogoItem(id_catalogo_item) {
            var URL = "{{ route('inactivar_catalogo_items') }}";
            var token = '{{ csrf_token() }}';
            var data = {
                id_catalogo_item: id_catalogo_item
            };
            $.ajax({
                url: URL,
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(response) {
                    if (!response.success) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);

                        window.location.reload();

                    }
                },
                error: function(response) {
                    toastr.error(response.mensaje);
                }
            });
        }
    </script>
@endsection
