@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="nombre">Seleccione autizacion:</label>
                                        {{ Form::select('rol', @$rol, isset($usuario) ? $usuario->rol : null, ['id' => 'id_renglon', 'class' => 'form-control ', 'class' => 'form-control select-estilo', 'placeholder' => 'Seleccione...']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre completo:</label>
                                        <input type="text" class="form-control" id="nombre"
                                            value="{{ isset($usuario) ? $usuario->name : null }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label for="nombre">Correo Electronico:</label>
                                        <input type="text" class="form-control" id="estado"
                                            value="{{ isset($usuario) ? $usuario->email : null }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Estado asignado:</label>
                                        {{ Form::select('estado', @$estado, isset($usuario) ? $usuario->estado : null, ['id' => 'id_renglon', 'class' => 'form-control ', 'class' => 'form-control select-estilo', 'placeholder' => 'Seleccione...']) }}
                                    </div>
                                </div>
                            </div>
                            <!-- Botón de envío del formulario -->
                            <div class="justify-content-center text-center">
                                <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg "><i
                                        class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
