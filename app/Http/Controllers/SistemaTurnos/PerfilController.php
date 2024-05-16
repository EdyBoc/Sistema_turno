<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        return view('sistemaTurnos.perfil.index_horas_extras');
    }

    public function view_solicitudes(Request $request)
    {
        return view('sistemaTurnos.perfil.index_solicitudes');
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

        $fh_catalogo = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;
    }
}
