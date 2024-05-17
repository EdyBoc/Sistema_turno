<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Autorizacion;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Solicitud;
use Illuminate\Support\Facades\Auth;
use App\Models\baseModel;
use Carbon\Carbon;
use Response;
use Storage;
use View;


class PerfilController extends Controller
{

    public function view_perfil(Request $request)
    {
        return view('sistemaTurnos.perfil.index_perfil');
    }

    public function view_horas_extras(Request $request)
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

        return view('sistemaTurnos.perfil.index_horas_extras', $reportehora);
    }

    public function view_solicitudes(Request $request)
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

        return view('sistemaTurnos.perfil.index_solicitudes', $solicitud);
    }

    public function guardar_solicitud(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tipo_solicitud' => 'required',
                'comentario_solicitud' => 'required',
            ],
            [
                'tipo_solicitud.required' => 'Debe seleccionar un tipo de solicitud',
                'comentario_solicitud.required' => 'Debe ingresar un comentario',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ingresar un nombre valido de catalogo',
            ]);
        }

        $userId = Auth::id();

        $fecha_solicitud = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $solicitud = new Solicitud();
        $solicitud->id_usuario = $userId;
        $solicitud->tipo_solicitud = $request->tipo_solicitud;
        $solicitud->fecha_solicitud = $fecha_solicitud;
        $solicitud->obervacion = $request->comentario_solicitud;
        $solicitud->user = $user;
        $solicitud->fn_ingreso = $fn_ingreso;
        $solicitud->ip = $ip;
        if ($solicitud->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }

    public function guardar_reporte_horas(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'inicio_hora' => 'required',
                'fin_hora' => 'required',
                'fecha_reporte_horas' => 'required',
            ],
            [
                'inicio_hora' => 'Debe ingresar hora de inicio',
                'fin_hora' => 'Debe ingresar hora de fin',
                'fecha_reporte_horas' => 'Debe ingresar una fecha',

            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }

        $userId = Auth::id();
        $fecha_solicitud = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $reportehoras = new ReporteHoras();
        $reportehoras->id_usuario = $userId;
        $reportehoras->inicio_hora = $request->inicio_hora;
        $reportehoras->fin_hora = $request->fin_hora;
        $reportehoras->fecha_reporte_horas = $request->fecha_reporte_horas;
        $reportehoras->user = $user;
        $reportehoras->fn_ingreso = $fn_ingreso;
        $reportehoras->ip = $ip;
        if ($reportehoras->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }
}
