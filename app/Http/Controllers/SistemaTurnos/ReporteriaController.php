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

    public function getData(Request $request)
    {
        // Suponiendo que tienes un modelo llamado ControlHoras que contiene los datos necesarios
        $data = ControlHoras::selectRaw('task, SUM(hours) as hours')
            ->groupBy('task')
            ->get()
            ->toArray();

        // Formatear datos para Google Charts
        $formattedData = [['Task', 'Hours']];
        foreach ($data as $row) {
            $formattedData[] = [$row['task'], (int)$row['hours']];
        }

        return response()->json($formattedData);
    }
}
