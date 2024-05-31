<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Persona;
use App\Models\SistemaTurnos\ReporteHoras;
use App\Models\SistemaTurnos\Solicitud;
use Illuminate\Support\Facades\Auth;
use App\Models\baseModel;
use Carbon\Carbon;
use Response;
use Storage;
use View;


class RrhhController extends Controller
{

    public function listar(Request $request)
    {

        $totalReporteHoras = ReporteHoras::whereNull('estado')->orWhere('estado', '')->count();
        $totalSolicitudes = Solicitud::whereNull('estado')->orWhere('estado', '')->count();

        return view('sistemaTurnos.rrhh.index_listar', [
            'totalReporteHoras' => $totalReporteHoras,
            'totalSolicitudes' => $totalSolicitudes,
        ]);
    }

    public function view_nueva_alta(Request $request)
    {
        $id_persona = $request->id;
        $persona = Persona::find($id_persona);

        return view('sistemaTurnos.rrhh.index_alta', ['persona' => $persona]);
    }

    public function lista_personas(Request $request)
    {
        $persona['personas'] = Persona::all();
        return view('sistemaTurnos.rrhh.lista_personas', $persona);
    }




    public function guardar_personas_altas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cui' => 'required',
            'nombre_completo' => 'required',
            'telefono' => 'required',
            'correo_electronico' => 'required',
            'fh_nacimiento' => 'required',
            'direccion' => 'required',
            'sexo' => 'required',
            'nit' => 'required',
            'nit' => 'required',
            'departamento' => 'required',
            'pais' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe llenar todos los campos',
            ]);
        }



        $userId = Auth::id();
        $fh_contratado = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $existentePersonas = Persona::where('id_persona', $request->id_persona)
            ->first();

        if ($existentePersonas) {
            $persona = Persona::find($request->id_persona);
            $persona->cui = $request->cui;
            $persona->nombre_completo = $request->nombre_completo;
            $persona->telefono = $request->telefono;
            $persona->correo_electronico = $request->correo_electronico;
            $persona->fh_nacimiento = $request->fh_nacimiento;
            $persona->direccion = $request->direccion;
            $persona->sexo = $request->sexo;
            $persona->nit = $request->nit;
            $persona->departamento = $request->departamento;
            $persona->pais = $request->pais;
            $persona->fh_contratado = $fh_contratado;
            $persona->estado = true;
            $persona->user = $user;
            $persona->fn_ingreso = $fn_ingreso;
            $persona->ip = $ip;
            if ($persona->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se ha actualizado la persona',
                ]);
            }
        } else {

            $persona = new Persona();
            $persona->cui = $request->cui;
            $persona->nombre_completo = $request->nombre_completo;
            $persona->telefono = $request->telefono;
            $persona->correo_electronico = $request->correo_electronico;
            $persona->fh_nacimiento = $request->fh_nacimiento;
            $persona->direccion = $request->direccion;
            $persona->sexo = $request->sexo;
            $persona->nit = $request->nit;
            $persona->departamento = $request->departamento;
            $persona->pais = $request->pais;
            $persona->fh_contratado = $fh_contratado;
            $persona->estado = true;
            $persona->user = $user;
            $persona->fn_ingreso = $fn_ingreso;
            $persona->ip = $ip;
            if ($persona->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Se ha registrado persona',
                ]);
            }
        }
    }
}
