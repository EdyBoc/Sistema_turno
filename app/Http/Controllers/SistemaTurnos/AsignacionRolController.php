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


class AsignacionRolController extends Controller
{

    public function index()
    {
        //$dependencia = Dependencia::paginate(5);
        //return view('dependencia.index',compact('blogs'));
        return view('dependencia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dependencia.crear');
    }
}
