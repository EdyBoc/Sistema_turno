<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\SistemaTurnos\ControlHoras;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class ReporteriaController extends Controller
{

    public function vista(Request $request)
    {
        return view('sistemaTurnos.reporteria.index');
    }

    public function horasSalidaChart(Request $request)
    {
        $fhInicial = $request->input('inicio_hora');
        $fhFinal = $request->input('fin_hora');
        $fh_control = $request->input('fh_control');

        $data = ControlHoras::when($fhInicial && $fhFinal, function ($query) use ($fhInicial, $fhFinal) {
            // Parsear las horas de inicio y fin
            $horaInicio = Carbon::parse($fhInicial);
            $horaFin = Carbon::parse($fhFinal);

            return $query->where(function ($query) use ($horaInicio, $horaFin) {
                // Condición para horas de inicio entre $fhInicial y $fhFinal
                $query->whereTime('inicio_hora', '>=', $horaInicio)
                    ->whereTime('inicio_hora', '<=', $horaFin);
            });
        })->get();
        //return response()->json($data);
        return response::json($data);
    }
}
