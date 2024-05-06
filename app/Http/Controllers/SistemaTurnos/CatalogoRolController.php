<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SistemaTurnos\Catalogo_rol;
use App\Models\baseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;
use DB;

class CatalogoRolController extends Controller
{

    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function vista(Request $request)
    {
        $catalogo_rol['catalogo_roles'] = Catalogo_rol::all();
        return view('sistemaTurnos.catalogos.roles.index', $catalogo_rol);
    }
}
