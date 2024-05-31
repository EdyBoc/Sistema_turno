<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\Encrypter;
use App\Models\baseModel;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\Vacacion;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Solicitud;
use App\Models\SistemaTurnos\Vw_usuario_autorizados;
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

        $vw_usuario_autorizado['vw_usuario_autorizados'] = Vw_usuario_autorizados::where('estado', true)->get();

        return view('sistemaTurnos.vacacion.index_vacaciones', $vw_usuario_autorizado);
    }

    public function crear_vacaciones(Request $request)
    {
        $dias = array_map(function ($i) {
            return $i;
        }, range(1, 15));

        $this->pageData['dias'] = $dias;

        $id_persona = $request->id;
        $persona = Persona::find($id_persona);

        return view('sistemaTurnos.vacacion.crear_vacaciones', ['persona' => $persona]);
    }
}
