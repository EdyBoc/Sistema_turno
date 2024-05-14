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


class PerfilController extends Controller
{

    public function view_perfil(Request $request)
    {
        return view('sistemaTurnos.perfil.index_perfil');
    }
}
