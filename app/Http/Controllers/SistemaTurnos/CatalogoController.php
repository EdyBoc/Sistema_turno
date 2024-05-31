<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Catalogo_dependencia;
use App\Models\SistemaTurnos\Catalogo_turno;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Response;
use Storage;
use View;
use DB;

class CatalogoController extends Controller
{

    public function catalogo(Request $request)
    {
        return view('sistemaTurnos.catalogos.index');
    }

    public function view_catalogo_dependencia(Request $request)
    {
        $catalogo_dependencia['catalogo_dependencias'] = Catalogo_dependencia::all();

        return view('sistemaTurnos.catalogos.dependencia.index_dependencia', $catalogo_dependencia);
    }

    public function view_catalogo_turno(Request $request)
    {
        $catalogoturno['catalogoturnos'] = Catalogo_turno::all();

        return view('sistemaTurnos.catalogos.turno.index_turno', $catalogoturno);
    }

    public function guardar_catalogo_dependencia(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nombre_dependencia' => 'required',
                'descripcion_dependencia' => 'required',
            ],
            [
                'nombre_dependencia.required' => 'Debe ingresar nombre de tipo dependencia',
                'descripcion_dependencia.required' => 'Debe ingresar un comentario',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }

        $fn_catalogo_rol = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $catalogo_dependencia = new Catalogo_dependencia();
        $catalogo_dependencia->nombre = $request->nombre_dependencia;
        $catalogo_dependencia->descripcion = $request->descripcion_dependencia;
        $catalogo_dependencia->fn_catalogo_rol = $fn_catalogo_rol;
        $catalogo_dependencia->user = $user;
        $catalogo_dependencia->fn_ingreso = $fn_ingreso;
        $catalogo_dependencia->ip = $ip;
        if ($catalogo_dependencia->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }

    public function guardar_dependencia_editado(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'editar_nombre_dependencia' => 'required',
                'editar_descripcion_dependencia' => 'required',
            ],
            [
                'editar_nombre_dependencia.required' => 'Debe ingresar nombre de tipo dependencia',
                'editar_descripcion_dependencia.required' => 'Debe ingresar un comentario',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }

        $fn_catalogo_rol = Carbon::now();
        $fn_ultima_modificacion = Carbon::now();


        $catalogo_dependencia = Catalogo_dependencia::find($request->id_catalogo_dependencia);
        $catalogo_dependencia->nombre = $request->editar_nombre_dependencia;
        $catalogo_dependencia->descripcion = $request->editar_descripcion_dependencia;
        $catalogo_dependencia->fn_catalogo_rol = $fn_catalogo_rol;
        $catalogo_dependencia->fn_ultima_modificacion = $fn_ultima_modificacion;
        if ($catalogo_dependencia->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }


    public function guardar_catalogo_turno(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'nombre_turno' => 'required',
                'inicio_hora' => 'required',
                'fin_hora' => 'required',
                'descripcion_turno' => 'required',
            ],
            [
                'nombre_turno.required' => 'Debe ingresar nombre de tipo turno',
                'inicio_hora.required' => 'Debe ingresar hora inicio',
                'fin_hora.required' => 'Debe ingresar hora fin',
                'descripcion_turno.required' => 'Debe ingresar un comentario',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }

        $fn_catalogo_turno = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $catalogo_turno = new Catalogo_turno();
        $catalogo_turno->nombre = $request->nombre_turno;
        $catalogo_turno->inicio_hora = $request->inicio_hora;
        $catalogo_turno->fin_hora = $request->fin_hora;
        $catalogo_turno->descripcion = $request->descripcion_turno;
        $catalogo_turno->fn_catalogo_turno = $fn_catalogo_turno;
        $catalogo_turno->user = $user;
        $catalogo_turno->fn_ingreso = $fn_ingreso;
        $catalogo_turno->ip = $ip;
        if ($catalogo_turno->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }


    public function guardar_turno_editado(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'editar_nombre_turno' => 'required',
                'editar_incio_hora' => 'required',
                'editar_fin_hora' => 'required',
                'editar_descripcion_turno' => 'required',
            ],
            [
                'editar_nombre_turno.required' => 'Debe ingresar nombre de tipo turno',
                'editar_incio_hora.required' => 'Debe ingresar hora fin',
                'editar_fin_hora.required' => 'Debe ingresar hora fin',
                'editar_descripcion_turno.required' => 'Debe ingresar un comentario',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }

        $fn_catalogo_turno = Carbon::now();
        $fn_ultima_modificacion = Carbon::now();

        $catalogo_turno = Catalogo_turno::find($request->id_catalogo_turno);
        $catalogo_turno->nombre = $request->editar_nombre_turno;
        $catalogo_turno->inicio_hora = $request->editar_incio_hora;
        $catalogo_turno->fin_hora = $request->editar_fin_hora;
        $catalogo_turno->descripcion = $request->editar_descripcion_turno;
        $catalogo_turno->fn_ultima_modificacion = $fn_ultima_modificacion;
        $catalogo_turno->fn_catalogo_turno = $fn_catalogo_turno;
        if ($catalogo_turno->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha editado turno con exito',
            ]);
        }
    }
}
