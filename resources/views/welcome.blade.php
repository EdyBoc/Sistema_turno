@extends('layouts.auth_app')
@section('title')
    Publico
@endsection

@section('styles')
    <style>

    </style>
@endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header" >
            <h4 style="text-align: center;">Bienvenido al Sistema de Turnos </h4>
        </div>
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <div class="card-body pt-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group"  style="text-align: center;">
                        @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">INICIO</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">INICIAR SESION</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="ml-4 text-sm text-gray-700 underline">REGISTRARSE</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                    <h5 style="text-align: center;">Bienvenido al Sistema de Turnos </h5>
                    <div class="sidebar-brand" style="text-align: center;">
                        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/config.jpg') }}"
                            width="150" alt="Infyom Logo">
                        <a href="{{ url('/') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
