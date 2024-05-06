<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Catalogo;
use App\Models\SistemaTurnos\Catalogo_items;
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

    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function lista_catalogo(Request $request)
    {
        $estado = [
            true => 'Activo',
            false => 'Inactivo'
        ];

        $this->pageData['estado'] = $estado;

        $catalogo = Catalogo::pluck('nombre', 'id_catalogo');

        $this->pageData['catalogo'] = $catalogo;


        return view('sistemaTurnos.catalogos.catalogo.lista_catalogo', $this->pageData);
    }


    public function listar(Request $request)
    {

        $existentes = Catalogo::find($request->id_catalogo);

        if ($existentes) {
            $catalogo_items = Catalogo_items:: //where('esta_activo', true)
                select('id_catalogo_item', 'id_catalogo', 'nombre', 'estado', 'fh_catalogo_items')
                ->where('id_catalogo', $request->id_catalogo)
                ->orderBy('fh_catalogo_items', 'DESC')
                ->get();


            $data = $catalogo_items->map(function ($item) {
                return [
                    'id_catalogo_item' => $item->id_catalogo_item,
                    'nombre' => $item->nombre,
                    'estado' => $item->estado ? 'activo' : 'inactivo',
                    'fh_catalogo_items' => $item->fh_catalogo_items,
                ];
            });
            return response()->json($data, 200);
        } else {
            $data = ['mensaje' => 'Seleccione un Catalogo.'];
            return response()->json($data, 200);
        }
    }


    public function guardar_catalogo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required',
            ],
            [
                'nombre.required' => 'Debe ingresar nombre',
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

        $catalogo = new Catalogo();
        $catalogo->nombre = $request->nombre;
        $catalogo->fh_catalogo = $fh_catalogo;
        $catalogo->user = $user;
        $catalogo->fn_ingreso = $fn_ingreso;
        $catalogo->ip = $ip;
        if ($catalogo->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }

    public function inactivar_catalogo_items(Request $request)
    {
        $catalogo_items = Catalogo_items::find($request->id_catalogo_item);
        if ($catalogo_items) {
            $catalogo_items->estado = !$catalogo_items->estado;
            if ($catalogo_items->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'El estado del  catalogo ítem se ha actualizado correctamente.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el estado',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se puede cambiar de estado.',
            ]);
        }
    }
}
