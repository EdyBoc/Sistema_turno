<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SistemaTurnos\Persona;
use App\Models\baseModel;
use Carbon\Carbon;
use Validator;
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
}
