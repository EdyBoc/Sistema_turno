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


class CatalogoController extends Controller
{

    public function catalogo(Request $request)
    {
        return view('sistemaTurnos.catalogos.index');
    }
}
