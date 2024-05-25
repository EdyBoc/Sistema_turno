<?php

namespace App\Http\Controllers\SistemaTurnos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\SistemaTurnos\Codigo_ingreso;
use App\Models\SistemaTurnos\ControlHoras;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

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

        $id_usuario = Auth::id();
        $codigo = $request->input('codigo');

        $codigoIngreso = Codigo_ingreso::where('id_usuario', $id_usuario)
            ->where('codigo', $codigo)
            ->where('estado', true)
            ->first();

        if (!$codigoIngreso) {
            return response()->json([
                'success' => false,
                'message' => 'Codigo no coinciden con nuestros registros.',
            ]);
        }


        try {

            $fh_control = Carbon::now();
            $fn_ingreso = Carbon::now();
            //$ip = $request->ip();
            $ip = $request->header('X-Forwarded-For') ?? $request->ip();
            $user = $request->user()->name;
            $inicio_hora = Carbon::now()->format('H:i:s');


            $marcage_ultimo_ingreso = ControlHoras::where('id_usuario', $codigoIngreso->id_usuario)
                ->where('inicio_hora', '>', Carbon::now()->subMinutes(30))
                ->whereNull('fin_hora')
                ->orderBy('inicio_hora', 'desc')
                ->first();


            if (!$marcage_ultimo_ingreso) {
                // No hay entradas recientes, entonces podemos crear una nueva
                $control_horas = new ControlHoras();
                $control_horas->inicio_hora = $inicio_hora;
                $control_horas->id_usuario = $codigoIngreso->id_usuario;
                $control_horas->fh_control = $fh_control;
                $control_horas->estado = false;
                $control_horas->user = $user;
                $control_horas->fn_ingreso = $fn_ingreso;
                $control_horas->ip = $ip;

                if ($control_horas->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Se ha registrado su ingreso, Bienvenido',
                    ]);
                }
            } else {
                // Ya hay una entrada reciente para este usuario
                return response()->json([
                    'success' => false,
                    'message' => 'Ya ha marcado su ingreso recientemente',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo realizar el registro de su ingreso,',
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


        $id_usuario = Auth::id();
        $codigo = $request->input('codigo');

        $codigoIngreso = Codigo_ingreso::where('id_usuario', $id_usuario)
            ->where('estado', true)
            ->where('codigo', $codigo)
            ->first();

        if (!$codigoIngreso) {
            return response()->json([
                'success' => false,
                'message' => 'Codigo no coinciden con nuestros registros.',
            ]);
        }

        $control_horas = ControlHoras::where('id_usuario', $codigoIngreso->id_usuario)
            ->whereNull('fin_hora')
            ->orderBy('inicio_hora', 'desc')
            ->first();

        if (!empty($control_horas->inicio_hora) && $control_horas->inicio_hora !== null) {
            $fin_hora = Carbon::now()->format('H:i:s');

            if (empty($control_horas->fin_hora) || $control_horas->fin_hora == null) {
                // Si 'fin_hora' está vacío, se puede actualizar
                $control_horas->fin_hora = $fin_hora;
                $control_horas->estado = true;
                if ($control_horas->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Se ha registrado su salida',
                    ]);
                }
            } else {
                // 'fin_hora' no está vacío, por lo que no se puede ingresar
                return response()->json([
                    'success' => false,
                    'message' => 'Ya ha registrado su salida anteriormente',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No hay registro de entrada para este usuario',
            ]);
        }
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
