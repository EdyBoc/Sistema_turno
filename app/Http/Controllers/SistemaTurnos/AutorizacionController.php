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


class AutorizacionController extends Controller
{
    public function view_autorizacion(Request $request)
    {
        return view('sistemaTurnos.autorizacion.index_autorizacion');
    }

    public function view_autorizacion_horas(Request $request)
    {
        return view('sistemaTurnos.autorizacion.autorizacion_horas');
    }

    public function view_autorizacio_solicitud(Request $request)
    {
        return view('sistemaTurnos.autorizacion.autorizacion_solicitud');
    }
}
