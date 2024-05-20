<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SistemaTurnos\Solicitud;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\baseModel;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class AutorizacionController extends Controller
{
    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function view_autorizacion(Request $request)
    {
        return view('sistemaTurnos.autorizacion.index_autorizacion');
    }

    public function view_autorizacion_horas(Request $request)
    {

        $reportehora['reportehoras'] = ReporteHoras::all();

        foreach ($reportehora['reportehoras'] as &$estado_reporte) {
            if ($estado_reporte->estado === 1) {

                $estado_reporte->estado = 'Autorizado';
            } elseif ($estado_reporte->estado === 0) {

                $estado_reporte->estado = 'No autorizado';
            } else {
                $estado_reporte->estado = 'Pendiente de Autorizacion';
            }
        }


        $usuarios = Vw_usuarios::pluck('name', 'id');

        $this->pageData['usuarios'] = $usuarios;


        return view('sistemaTurnos.autorizacion.autorizacion_horas', $reportehora, $this->pageData);
    }

    public function view_autorizacio_solicitud(Request $request)
    {

        $solicitud['solicitudes'] = Solicitud::all();

        foreach ($solicitud['solicitudes'] as &$estado_solicitud) {
            if ($estado_solicitud->estado === 1) {

                $estado_solicitud->estado = 'Autorizado';
            } elseif ($estado_solicitud->estado === 0) {

                $estado_solicitud->estado = 'No autorizado';
            } else {
                $estado_solicitud->estado = 'Pendiente de Autorizacion';
            }
        }

        return view('sistemaTurnos.autorizacion.autorizacion_solicitud', $solicitud);
    }

    public function consulta(Request $request)
    {
    }
}
