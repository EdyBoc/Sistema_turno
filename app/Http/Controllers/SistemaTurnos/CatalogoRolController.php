<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SistemaTurnos\Catalogo_rol;
use App\Models\baseModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Response;
use Storage;
use View;
use DB;

class CatalogoRolController extends Controller
{

    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function vista(Request $request)
    {
        $catalogo_rol['catalogo_roles'] = Catalogo_rol::all();
        return view('sistemaTurnos.catalogos.roles.index', $catalogo_rol);
    }

    public function guardar_catalogo_rol(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'catalogo_rol' => 'required',
                'descripcion' => 'required',
            ],
            [
                'catalogo_rol.required' => 'Debe ingresar nombre de Rol',
                'descripcion.required' => 'Debe ingresar descripcion de Rol',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ingresar un nombre valido de catalogo',
            ]);
        }


        $fn_catalogo_rol = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $catalogo_rol = new Catalogo_rol();

        $catalogo_rol->nombre = $request->catalogo_rol;
        $catalogo_rol->fn_catalogo_rol = $fn_catalogo_rol;
        $catalogo_rol->descripcion = $request->descripcion;
        $catalogo_rol->user = $user;
        $catalogo_rol->fn_ingreso = $fn_ingreso;
        $catalogo_rol->ip = $ip;
        if ($catalogo_rol->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }
}
