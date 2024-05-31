<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\SistemaTurnos\Catalogo_rol;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\roles;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $id_usuario = Auth::id();

        $rol = roles::where('id_usuario', $id_usuario)
            ->where('estado', true)
            ->first();

        $rol_usuario = '';

        if ($rol) {
            if ($rol->id_catalogo_rol == config('constantes.ADMINISTRADOR')) {
                $rol_usuario = 'Administrador';
            } elseif ($rol->id_catalogo_rol == config('constantes.COORDINADOR')) {
                $rol_usuario = 'Coordinador';
            } elseif ($rol->id_catalogo_rol == config('constantes.EMPLEADO')) {
                $rol_usuario = 'Empleado';
            }
        }

        // Pasar el rol del usuario a la vista
        return view('home', ['rol_usuario' => $rol_usuario]);
    }
}
