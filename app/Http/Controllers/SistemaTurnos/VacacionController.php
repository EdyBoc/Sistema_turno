<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\SistemaTurnos\Persona;
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
        return view('sistemaTurnos.vacacion.index_vacaciones');
    }

    public function crear_vacaciones(Request $request)
    {
        $dias = array_map(function ($i) {
            return $i;
        }, range(1, 30));

        $this->pageData['dias'] = $dias;

        $persona = Persona::pluck('nombre_completo', 'id_persona');

        $this->pageData['persona'] = $persona;

        return view('sistemaTurnos.vacacion.crear_vacaciones', $this->pageData);
    }
}
