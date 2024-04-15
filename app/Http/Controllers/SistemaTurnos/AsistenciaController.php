<?php

namespace App\Http\Controllers\SistemaTurnos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\Session;


class AsistenciaController extends Controller
{

    public function marcaje_ingreso(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'codigo' => 'required',
            ],
            [
                'codigo.required' => 'Debe ingresar codigo',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error, ingrese su codigo',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Se ha registrado su ingreso, Bienvenido',
        ]);
    }

    public function marcaje_salida(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'codigo' => 'required',
            ],
            [
                'codigo.required' => 'Debe ingresar codigo',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error, ingrese su codigo',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Se ha registrado su salida',
        ]);
    }



    /*public function guardar_profesion(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'catalogo_item' => 'required',
                'descripcion' => 'required',
            ],
            [
                'catalogo_item.required' => 'Debe ingresar catálogo item.',
                'descripcion.required' => 'Debe ingresar descripción',
            ]
        );

        if ($validator->fails()) {
            return response()->json(baseModel::sysResponse(false, 'Campos requeridos. <br> - ' . implode('<br> - ', $validator->errors()->all())));
        } else {
            try {
                $id_profesion = $request->input('id_profesion');
                if (!empty($id_profesion) && $id_profesion !== null) {
                    //Si existe contrato ingresa para actualizar
                    baseModel::usuarioModifica();
                    baseModel::ipUsuario();

                    $profesion = Profesion::find($request->id_profesion);
                    $profesion->profesion = $request->catalogo_item;
                    $profesion->descripcion = $request->descripcion;
                    $profesion->esta_activo = true;
                    if ($profesion->save()) {
                        return response()->json(baseModel::sysResponse(true, 'Se ha editado exitosamente los datos de profesion.'));
                    }
                } else {
                    baseModel::usuarioModifica();
                    baseModel::ipUsuario();
                    $profesion = new Profesion();
                    $profesion->profesion = $request->catalogo_item;
                    $profesion->descripcion = $request->descripcion;
                    $profesion->esta_activo = true;
                    if ($profesion->save()) {
                        return Response::json(baseModel::sysResponse(true, 'Se ha sido guardada exitosamente datos de profesion.'));
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('message-title', 'Hubo problemas');
                Session::flash('message-error', 'No pudo ser guardar datos de profesion.');
                return response()->json(baseModel::sysResponse(false));
            }
        }
    }

    public function editar_profesion(Request $request)
    {
        $profesion = Profesion::find($request->id_profesion);

        return response()->json([
            'catalogo_item' => $profesion->profesion,
            'descripcion' => $profesion->descripcion,
        ]);
    }


    public function guardar_editado_profesion(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'catalogo_item' => 'required',
                'descripcion' => 'required',
            ],
            [
                'catalogo_item.required' => 'Debe ingresar catálogo item.',
                'descripcion.required' => 'Debe ingresar descripción',
            ]
        );

        if ($validator->fails()) {
            return response()->json(baseModel::sysResponse(false, 'Campos requeridos. <br> - ' . implode('<br> - ', $validator->errors()->all())));
        } else {
            try {
                $id_profesion = $request->input('id_profesion');

                if (!empty($id_profesion) && $id_profesion !== null) {
                    //Si existe contrato ingresa para actualizar
                    baseModel::usuarioModifica();
                    baseModel::ipUsuario();

                    $profesion = Profesion::find($request->id_profesion);
                    $profesion->profesion = $request->catalogo_item;
                    $profesion->descripcion = $request->descripcion;
                    $profesion->esta_activo = true;
                    if ($profesion->save()) {
                        return response()->json(baseModel::sysResponse(true, 'Se ha editado exitosamente los datos de profesion.'));
                    }
                } else {
                    return Response::json(baseModel::sysResponse(false, 'Error al editar no existe registro de profesión'));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Session::flash('message-title', 'Hubo problemas');
                Session::flash('message-error', 'No pudo ser guardar datos de profesion.');
                return response()->json(baseModel::sysResponse(false));
            }
        }
    }*/
}
