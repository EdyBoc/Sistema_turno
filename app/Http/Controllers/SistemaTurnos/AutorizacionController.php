<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SistemaTurnos\Solicitud;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\SistemaTurnos\Autorizacion;
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

    public function guardar_solicitud_editado(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'comentario' => 'required',
                'tipo_autorizacion' => 'required',
            ],
            [
                'comentario.required' => 'Debe ingresar nombre de Rol',
                'tipo_autorizacion.required' => 'Debe ingresar descripcion de Rol',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }


        $solicitud = Solicitud::find($request->id_solicitud);
        $solicitud->estado = $request->tipo_autorizacion;
        if ($solicitud->save()) {

            $fecha_autorizacion = Carbon::now();
            $fn_ingreso = Carbon::now();
            $fn_ultima_modificacion = Carbon::now();
            $ip = $request->ip();
            $user = $request->user()->name;

            $autorizacion = Autorizacion::where('id_solicitud', $solicitud->id_solicitud)->first();

            if ($autorizacion) {
                // Si existe, actualiza la autorización
                $autorizacion->obervacion = $request->comentario;
                $autorizacion->fecha_autorizacion = $fecha_autorizacion;
                $autorizacion->estado = $request->tipo_autorizacion;
                $autorizacion->user = $user;
                $autorizacion->fn_ultima_modificacion = $fn_ultima_modificacion;
                $autorizacion->ip = $ip;

                if ($autorizacion->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Se ha edito con exito',
                    ]);
                }
            } else {
                // Si no existe, crea una nueva autorización
                $autorizacion = new Autorizacion();
                $autorizacion->id_solicitud = $solicitud->id_solicitud;
                $autorizacion->obervacion = $request->comentario;
                $autorizacion->fecha_autorizacion = $fecha_autorizacion;
                $autorizacion->estado = $request->tipo_autorizacion;
                $autorizacion->user = $user;
                $autorizacion->fn_ingreso = $fn_ingreso;
                $autorizacion->ip = $ip;

                if ($autorizacion->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Se ha registrado con exito',
                    ]);
                }
            }
        } else {
            if ($autorizacion->save()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo realizar el registro',
                ]);
            }
        }
    }
}
