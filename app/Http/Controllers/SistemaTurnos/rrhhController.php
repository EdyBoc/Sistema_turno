<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Persona;
use App\Models\baseModel;
use Carbon\Carbon;
use Response;
use Storage;
use View;


class RrhhController extends Controller
{

    public function listar(Request $request)
    {

        $personas = Persona::all();

        foreach ($personas as $persona) {
            $estadoPersona = $persona->estado; // Obtener el estado de la persona actual

            switch ($estadoPersona) {
                case 1:
                    $persona->estado_texto = "Alta";
                    break;
                case 2:
                    $persona->estado_texto = "Baja";
                    break;
                case 3:
                    $persona->estado_texto = "Inactivo";
                    break;
                default:
                    $persona->estado_texto = "Estado desconocido: " . $estadoPersona;
            }
        }

        return view('sistemaTurnos.rrhh.index_listar', compact('personas'));
    }

    public function view_nueva_alta(Request $request)
    {
        return view('sistemaTurnos.rrhh.index_alta');
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
