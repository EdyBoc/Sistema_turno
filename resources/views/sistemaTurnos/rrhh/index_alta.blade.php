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
            <h3 class="page__heading">Formulario de Altas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cui">CUI:</label>
                                            <input type="number" class="form-control" id="cui" name="cui"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_completo">Nombre Completo:</label>
                                            <input type="text" class="form-control" id="nombre_completo"
                                                name="nombre_completo" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="pais">pais:</label>
                                            <input type="text" class="form-control" id="pais" name="pais"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="departamento">Departamento:</label>
                                            <input type="text" class="form-control" id="departamento" name="departamento"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fh_nacimiento">Fecha de Nacimiento:</label>
                                            <input type="date" class="form-control" id="fh_nacimiento"
                                                name="fh_nacimiento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="correo_electronico">Correo Electrónico:</label>
                                            <input type="email" class="form-control" id="correo_electronico"
                                                name="correo_electronico" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección:</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono:</label>
                                            <input type="number" class="form-control" id="telefono" name="telefono"
                                                required>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nit">NIT:</label>
                                            <input type="number" class="form-control" id="nit" name="nit"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono_emergencia">Teléfono de Emergencia:</label>
                                            <input type="number" class="form-control" id="telefono_emergencia"
                                                name="telefono_emergencia" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="sexo">Sexo:</label>
                                            <select class="form-control" id="sexo" name="sexo" required>
                                                <option value="M">Masculino</option>
                                                <option value="F">Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-danger btn-lg" href="/index_listar"><i
                                        class="fas fa-reply"></i></i>Regrar</a>
                                <button type="submit" class="btn btn-primary btn-lg">Guardar</button>

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
    </script>
@endsection
