<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\Encrypter;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\SistemaTurnos\Catalogo_rol;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\roles;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class UsuariosController extends Controller
{

    protected $pageData;
    protected $encrypter;

    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
        $this->pageData = [];
    }



    public function usuarios(Request $request)
    {

        $usuarios = Vw_usuarios::pluck('name', 'id');
        $this->pageData['usuarios'] = $usuarios;

        $catalogo_rol = Catalogo_rol::pluck('nombre', 'id_catalogo_rol');
        $this->pageData['catalogo_rol'] = $catalogo_rol;

        return view('sistemaTurnos.usuario.index_usuario', $this->pageData);
    }



    public function filtar_datos_usuario_rol(Request $request)
    {

        $id_usuario = $request->input('id_usuario');

        $asignacione_rols = roles::where('id_usuario', $id_usuario)->get();

        if ($asignacione_rols) {

            foreach ($asignacione_rols as $asignacion_rol) {

                $nombre_rol = Catalogo_rol::where('id_catalogo_rol', $asignacion_rol->id_catalogo_rol)
                    ->value('nombre');

                $nombre_usuario = Vw_usuarios::where('id', $asignacion_rol->id_usuario)
                    ->value('name');

                $asignacion_rol->nombre_rol = $nombre_rol;
                $asignacion_rol->nombre_usuario = $nombre_usuario;


                if ($asignacion_rol->estado === 1) {
                    $asignacion_rol->estado = 'Activo';
                } elseif ($asignacion_rol->estado === 0) {
                    $asignacion_rol->estado = 'Inactivo';
                }
            }
        }


        $datos = [];

        foreach ($asignacione_rols as $asignacion) {

            $datos[] = [
                'nombre_usuario' => $asignacion->nombre_usuario,
                'nombre_rol' => $asignacion->nombre_rol,
                'fh_asignacion' => $asignacion->fh_asignacion,
                'estado' => $asignacion->estado
            ];
        }
        return response()->json($datos);
    }



    public function consulta_recursos_humanos(Request $request)
    {

        $id_usuario = $request->input('id_usuario');

        $usuario = Vw_usuarios::where('id', $id_usuario)->first();

        if (!$usuario) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontro al usuario',
            ]);
        }

        $persona_alta = Persona::where('cui', $usuario->cui)->first();
        if (!$persona_alta) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario no esta de alta en Recursos Humano.',
            ]);
        }

        switch ($persona_alta->estado) {
            case 1:
                $persona_alta->estado = 'Alta';
                break;
            case 2:
                $persona_alta->estado = 'Vacaciones';
                break;
            case 3:
                $persona_alta->estado = 'Baja';
                break;
        }

        return response()->json([
            'success' => true,
            'id_persona' => $persona_alta->id_persona,
            'nombre_completo' => $persona_alta->nombre_completo,
            'cui' => $persona_alta->cui,
            'fh_contratado' => $persona_alta->fh_contratado,
            'estado' => $persona_alta->estado
        ]);
    }


    public function guardar_asignacion_rol(Request $request)
    {

        $userId = Auth::id();
        $fh_asignacion = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        roles::where('id_usuario', $request->id_usuario)
            ->where('estado', true)
            ->update(['estado' => false]);


        $existenteAsignacion = roles::where('id_usuario', $request->id_usuario)
            ->where('id_catalogo_rol', $request->id_catalogo_rol)
            ->first();


        if ($existenteAsignacion) {
            $existenteAsignacion->fh_asignacion = $fh_asignacion;
            $existenteAsignacion->id_persona = $request->id_persona;
            $existenteAsignacion->estado = true;
            $existenteAsignacion->user = $user;
            $existenteAsignacion->fn_ingreso = $fn_ingreso;
            $existenteAsignacion->ip = $ip;
            if ($existenteAsignacion->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se actualizo su asignacion turno',
                ]);
            }
        } else {

            $asignacion_turno = new roles();
            $asignacion_turno->id_catalogo_rol = $request->id_catalogo_rol;
            $asignacion_turno->id_persona = $request->id_persona;
            $asignacion_turno->id_usuario = $request->id_usuario;
            $asignacion_turno->fh_asignacion = $fh_asignacion;
            $asignacion_turno->estado = true;
            $asignacion_turno->user = $user;
            $asignacion_turno->fn_ingreso = $fn_ingreso;
            $asignacion_turno->ip = $ip;
            if ($asignacion_turno->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se ha registrado su asignacion turno',
                ]);
            }
        }
    }
}
