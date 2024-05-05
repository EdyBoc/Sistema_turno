<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\Vacacion;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;
use DB;

class VacacionController extends Controller
{

    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function vista(Request $request)
    {

        $vacacion['vacaciones'] = Vacacion::all();

        return view('sistemaTurnos.vacacion.index_vacaciones', $vacacion);
    }

    public function crear_vacaciones(Request $request)
    {
        $dias = array_map(function ($i) {
            return $i;
        }, range(1, 15));

        $this->pageData['dias'] = $dias;

        $persona = Persona::pluck('nombre_completo', 'id_persona');

        $this->pageData['persona'] = $persona;

        return view('sistemaTurnos.vacacion.crear_vacaciones', $this->pageData);
    }

    public function filtar_datos_persona(Request $request)
    {

        $id_persona = $request->input('persona');
        $persona = Persona::find($id_persona);

        $cui = $persona->cui;
        $correo_electronico = $persona->correo_electronico;
        $fecha_nacimiento = Carbon::createFromFormat('Y-m-d', $persona->fh_nacimiento);
        $fecha_contratado = $persona->fh_contratado;
        $edad = $fecha_nacimiento->diffInYears();
        $datos = [
            'cui' => $cui,
            'correo_electronico' => $correo_electronico,
            'edad' => $edad,
            'fecha_contratado' => $fecha_contratado
        ];
        return response()->json($datos);
    }
}
