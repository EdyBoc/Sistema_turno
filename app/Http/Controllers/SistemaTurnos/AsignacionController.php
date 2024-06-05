<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\Encrypter;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\SistemaTurnos\Catalogo_dependencia;
use App\Models\SistemaTurnos\Catalogo_turno;
use App\Models\SistemaTurnos\AsignacionDependencia;
use App\Models\SistemaTurnos\AsignacionTurno;
use Illuminate\Support\Facades\Auth;
use App\Models\baseModel;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class AsignacionController extends Controller
{

    protected $pageData;
    protected $encrypter;

    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
        $this->pageData = [];
    }


    public function asignacion(Request $request)
    {
        return view('sistemaTurnos.asignaciones.index_asignacion');
    }


    public function view_asignacion_dependencia(Request $request)
    {
        $usuarios = Vw_usuarios::pluck('name', 'id');
        $this->pageData['usuarios'] = $usuarios;

        $catalogo_dependencia = Catalogo_dependencia::pluck('nombre', 'id_catalogo_dependencia');
        $this->pageData['catalogo_dependencia'] = $catalogo_dependencia;

        return view('sistemaTurnos.asignaciones.dependencia.index_asignacion_dependencia', $this->pageData);
    }



    public function guardar_asignacion_dependencia(Request $request)
    {

        $userId = Auth::id();
        $fh_asignacion = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        AsignacionDependencia::where('id_usuario', $request->id_usuario)
            ->where('estado', true)
            ->update(['estado' => false]);


        $existenteAsignacion = AsignacionDependencia::where('id_usuario', $request->id_usuario)
            ->where('id_catalogo_dependencia', $request->id_catalogo_dependencia)
            ->first();


        if ($existenteAsignacion) {
            // Activate the existing assignment
            $existenteAsignacion->fh_asignacion = $fh_asignacion;
            $existenteAsignacion->estado = true;
            $existenteAsignacion->user = $user;
            $existenteAsignacion->fn_ingreso = $fn_ingreso;
            $existenteAsignacion->ip = $ip;
            if ($existenteAsignacion->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se actualizo su asignacion de dependencia',
                ]);
            }
        } else {
            // Create a new assignment
            $asignacion_dependencia = new AsignacionDependencia();
            $asignacion_dependencia->id_catalogo_dependencia = $request->id_catalogo_dependencia;
            $asignacion_dependencia->id_usuario = $request->id_usuario;
            $asignacion_dependencia->fh_asignacion = $fh_asignacion;
            $asignacion_dependencia->estado = true;
            $asignacion_dependencia->user = $user;
            $asignacion_dependencia->fn_ingreso = $fn_ingreso;
            $asignacion_dependencia->ip = $ip;
            if ($asignacion_dependencia->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se ha registrado su asignacion de dependencia',
                ]);
            }
        }
    }


    public function filtar_datos_usuario(Request $request)
    {

        $id_usuario = $request->input('id_usuario');
        $asignacione_turnos = AsignacionDependencia::where('id_usuario', $id_usuario)->get();

        if ($asignacione_turnos) {

            foreach ($asignacione_turnos as $asignacion_turno) {

                $nombre_dependencia = Catalogo_dependencia::where('id_catalogo_dependencia', $asignacion_turno->id_catalogo_dependencia)
                    ->value('nombre');

                $nombre_usuario = Vw_usuarios::where('id', $asignacion_turno->id_usuario)
                    ->value('name');

                $asignacion_turno->nombre_dependencia = $nombre_dependencia;

                $asignacion_turno->nombre_usuario = $nombre_usuario;

                if ($asignacion_turno->estado === 1) {
                    $asignacion_turno->estado = 'Activo';
                } elseif ($asignacion_turno->estado === 0) {
                    $asignacion_turno->estado = 'Inactivo';
                }
            }
        }

        $datos = [];

        foreach ($asignacione_turnos as $asignacion) {

            $datos[] = [
                'nombre_usuario' => $asignacion->nombre_usuario,
                'nombre_dependencia' => $asignacion->nombre_dependencia,
                'fh_asignacion' => $asignacion->fh_asignacion,
                'estado' => $asignacion->estado
            ];
        }
        return response()->json($datos);
    }


    public function view_asignacion_turno(Request $request)
    {

        $usuarios = Vw_usuarios::pluck('name', 'id');
        $this->pageData['usuarios'] = $usuarios;

        $catalogo_turno = Catalogo_turno::pluck('nombre', 'id_catalogo_turno');
        $this->pageData['catalogo_turno'] = $catalogo_turno;


        return view('sistemaTurnos.asignaciones.turno.index_asignacion_turno', $this->pageData);
    }


    public function filtar_datos_usuario_turno(Request $request)
    {

        $id_usuario = $request->input('id_usuario');
        $asignacione_turnos = AsignacionTurno::where('id_usuario', $id_usuario)->get();

        if ($asignacione_turnos) {

            foreach ($asignacione_turnos as $asignacion_turno) {

                $nombre_turno = Catalogo_turno::where('id_catalogo_turno', $asignacion_turno->id_catalogo_turno)
                    ->value('nombre');

                $nombre_usuario = Vw_usuarios::where('id', $asignacion_turno->id_usuario)
                    ->value('name');

                $inicio = Catalogo_turno::where('id_catalogo_turno', $asignacion_turno->id_catalogo_turno)
                    ->value('inicio_hora');

                $fin = Catalogo_turno::where('id_catalogo_turno', $asignacion_turno->id_catalogo_turno)
                    ->value('fin_hora');



                $asignacion_turno->nombre_turno = $nombre_turno;
                $asignacion_turno->nombre_usuario = $nombre_usuario;
                $asignacion_turno->inicio = $inicio;
                $asignacion_turno->fin = $fin;

                if ($asignacion_turno->estado === 1) {
                    $asignacion_turno->estado = 'Activo';
                } elseif ($asignacion_turno->estado === 0) {
                    $asignacion_turno->estado = 'Inactivo';
                }
            }
        }

        $datos = [];

        foreach ($asignacione_turnos as $asignacion) {

            $datos[] = [
                'nombre_usuario' => $asignacion->nombre_usuario,
                'nombre_dependencia' => $asignacion->nombre_turno,
                'inicio' => $asignacion->inicio,
                'fin' => $asignacion->fin,
                'fh_asignacion' => $asignacion->fh_asignacion,
                'estado' => $asignacion->estado
            ];
        }
        return response()->json($datos);
    }




    public function guardar_asignacion_turno(Request $request)
    {

        $userId = Auth::id();
        $fh_asignacion = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        AsignacionTurno::where('id_usuario', $request->id_usuario)
            ->where('estado', true)
            ->update(['estado' => false]);


        $existenteAsignacion = AsignacionTurno::where('id_usuario', $request->id_usuario)
            ->where('id_catalogo_turno', $request->id_catalogo_turno)
            ->first();


        if ($existenteAsignacion) {
            // Activate the existing assignment
            $existenteAsignacion->fh_asignacion = $fh_asignacion;
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
            // Create a new assignment
            $asignacion_turno = new AsignacionTurno();
            $asignacion_turno->id_catalogo_turno = $request->id_catalogo_turno;
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
