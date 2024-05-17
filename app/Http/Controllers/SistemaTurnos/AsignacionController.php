<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class AsignacionController extends Controller
{

    public function asignacion(Request $request)
    {
        return view('sistemaTurnos.asignaciones.index_asignacion');
    }
}
