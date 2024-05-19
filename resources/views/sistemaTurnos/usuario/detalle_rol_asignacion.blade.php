@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Formulario</h3>
        </div>
        <div class="section-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <h5 class="page__heading">Asignacion Rol</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="nombre">Seleccione autizacion:</label>
                                        {{ Form::select('rol', @$rol, isset($usuario) ? $usuario->rol : null, ['id' => 'id_renglon', 'class' => 'form-control ', 'class' => 'form-control select-estilo', 'placeholder' => 'Seleccione...']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Usuario:</label>
                                        <input type="text" class="form-control" id="nombre"
                                            value="{{ isset($usuario) ? $usuario->name : null }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    <div class="form-group">
                                        <label for="nombre">Correo Electronico:</label>
                                        <input type="text" class="form-control" id="estado"
                                            value="{{ isset($usuario) ? $usuario->email : null }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Estado asignacion:</label>
                                        {{ Form::select('estado', @$estado, isset($usuario) ? $usuario->estado : null, ['id' => 'id_renglon', 'class' => 'form-control ', 'class' => 'form-control select-estilo', 'placeholder' => 'Seleccione...']) }}
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id_persona"
                                            value="{{ isset($persona_alta) ? $persona_alta->id_persona : null }}">
                                    </div>

                                </div>
                            </div>
                            <!-- Botón de envío del formulario -->
                            <div class="justify-content-center text-center">
                                <a class="btn btn-danger btn-lg" href="{{ route('index_usuario') }}"><i
                                        class="fas fa-reply"></i></i>Regrar</a>

                                <a href="#" id="btn_guardar_profesion" class="btn btn-warning btn-lg "><i
                                        class="fas fa-plus-circle"></i>&nbsp;Guardar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    @if (isset($persona_alta) && $persona_alta)
                                        <h5 class="text-success">Esta registrado en RRHH</h5>
                                        <div class="form-group">
                                            <span for="nombre">Nombre Completo:</span>
                                            <span>{{ $persona_alta->nombre_completo }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span for="nombre">CUI:</span>
                                            <span>{{ $persona_alta->cui }}</span>
                                        </div>
                                        <div class="form-group">
                                            <span for="nombre">Estado:</span>
                                            <span>{{ $persona_alta->estado }}</span>
                                        </div>
                                    @else
                                        <h5 class="text-danger">No esta registrado en RRHH</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
