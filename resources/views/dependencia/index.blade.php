@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dependencia</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        @can('crear-dependencia')
                        <a class="btn btn-warning" href="{{ route('dependencia.create') }}">Nuevo</a>
                        @endcan

                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">Dependencia</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Administrador</td>
                                    <td>
                                        <a class="btn btn-primary" href="#">Editar</a>
                                        <button class="btn btn-danger">Borrar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Editor</td>
                                    <td>
                                        <a class="btn btn-primary" href="#">Editar</a>
                                        <button class="btn btn-danger">Borrar</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Usuario</td>
                                    <td>
                                        <a class="btn btn-primary" href="#">Editar</a>
                                        <button class="btn btn-danger">Borrar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection