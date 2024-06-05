<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Solicitud;
use App\Models\baseModel;
use Carbon\Carbon;
use Response;
use Storage;
use View;


class rrhhController extends Controller
{

    public function listar(Request $request)
    {

        $totalReporteHoras = ReporteHoras::whereNull('estado')->orWhere('estado', '')->count();
        $totalSolicitudes = Solicitud::whereNull('estado')->orWhere('estado', '')->count();

        return view('sistemaTurnos.rrhh.index_listar', [
            'totalReporteHoras' => $totalReporteHoras,
            'totalSolicitudes' => $totalSolicitudes,
        ]);
    }

    public function view_nueva_alta(Request $request)
    {
        return view('sistemaTurnos.rrhh.index_alta');
    }

    public function lista_personas(Request $request)
    {
        $persona['personas'] = Persona::all();
        return view('sistemaTurnos.rrhh.lista_personas', $persona);
    }




    public function guardar_personas_altas(Request $request)
    {
        $request->validate([
            'cui' => 'required|numeric',
            'nombre_completo' => 'required|string',
            'pais' => 'required|string',
            'departamento' => 'required|string',
            'fh_nacimiento' => 'required|date',
            'correo_electronico' => 'required|email',
            'direccion' => 'required|string',
            'telefono' => 'required|numeric',
            'nit' => 'required|numeric',
            'telefono_emergencia' => 'required|numeric',
            'sexo' => 'required|in:M,F',
        ]);



        $fh_catalogo = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;
    }
}
