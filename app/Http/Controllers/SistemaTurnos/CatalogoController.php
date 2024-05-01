<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\SistemaTurnos\Catalogo;
use App\Models\SistemaTurnos\Catalogo_items;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Response;
use Storage;
use View;
use DB;

class CatalogoController extends Controller
{

    public function catalogo(Request $request)
    {
        return view('sistemaTurnos.catalogos.index');
    }

    protected $pageData;

    public function __construct()
    {
        $this->pageData = [];
    }

    public function lista_catalogo(Request $request)
    {
        $estado = [
            true => 'Activo',
            false => 'Inactivo'
        ];

        $this->pageData['estado'] = $estado;

        $catalogo = Catalogo::pluck('nombre', 'id_catalogo');

        $this->pageData['catalogo'] = $catalogo;


        return view('sistemaTurnos.catalogos.catalogo.lista_catalogo', $this->pageData);
    }


    public function listar(request $request)
    {
        //DataTable contador de renderizacion
        $dataTablesResponse['draw'] = intval($request->draw);

        //obtengo datos de paginacion
        $limit = ($request->length != '') ? $request->length : false;
        $offset = $request->start;
        $order = $request->order;

        $tableCols = array(
            'No.',
            'Item',
            'Estado',
        );

        //limit
        if (!$limit) {
            $limit = config('constantes.datatableDefaultRows');
        }

        //offset
        if (!$offset) {
            $offset = 0;
        }

        // DEFINO LAS COLUMNAS QUE FORMARN EL LISTADO
        $columns = [
            'No.',
            'Item',
            'Estado',
        ];


        if (isset($request->estado) && $request->estado !== '') {
            $query = Catalogo_items::query()->where('esta_activo', filter_var($request->estado, FILTER_VALIDATE_BOOLEAN));
        } else {

            $query = Catalogo_items::query();
        }

        // Verificar si se proporciona un avanzado de búsqueda
        if (isset($request->avanzado) && $request->avanzado != '') {
            // Aplicar la condición de búsqueda si se proporciona un avanzado
            $query->where(function ($query) use ($request) {
                $avanzado = $request->avanzado;
                $query->where('nombre', 'like', "%$avanzado%")
                    ->orWhere('descripcion', 'like', "%$avanzado%");
            });
        }

        // Obtener los resultados
        $registros = $query->orderBy('nombre', 'desc')->get();

        // OBTENGO EL TOTAL DE REGISTROS INCLUIDOS EN LA LISTA=
        $total = $registros->count();

        // CONSTRUYO LA LISTA EN FORMATO HTML
        $results = [];

        if ($offset != 0) {
            $fila = $offset + 1;
        }

        $contador = ($offset > 0) ? $offset + 1 : 1;
        foreach ($registros as $registro => $item) {


            $linkEditar = '<a
                    title="Editar "
                    data-toggle="tooltip"
                    data-original-title="Prioridad"
                    class="btnUPD"
                    href="#"
                    onclick="modalEditarCatalogo(' . strval($item->id_catalogo) . ')"
                    > <i class="fas fa-edit listaIcon"></i></a>';


            $descripcion = $item->descripcion;
            $nombre = $item->nombre;
            $estado = $item->estado;

            if ($estado == true) {
                $estado_texto = "Activo";
            } else {
                $estado_texto = "Inactivo";
            }
            $results[] = [
                '<div style="text-align:center;" class="orden">' . $contador . '</div>',
                '<div style="text-align:center;" class="orden">' . $nombre . '</div>',
                '<div style="text-align:center;" class="orden">' . $descripcion . '</div>',
                '<div style="text-align:center;" class="orden">' . $estado_texto . '</div>',
                '<div style="text-align:center; width:100%;">' . $linkEditar . '</div>'

            ];
            $contador++;
        }
        $response = [
            'data' => $results,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
        ];

        return response()->json($response);
    }

    public function guardar_catalogo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nombre' => 'required',
            ],
            [
                'nombre.required' => 'Debe ingresar nombre',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Debe ingresar un nombre valido de catalogo',
            ]);
        }

        $fh_catalogo = Carbon::now();
        $fn_ingreso = Carbon::now();
        $ip = $request->ip();
        $user = $request->user()->name;

        $catalogo = new Catalogo();
        $catalogo->nombre = $request->nombre;
        $catalogo->fh_catalogo = $fh_catalogo;
        $catalogo->user = $user;
        $catalogo->fn_ingreso = $fn_ingreso;
        $catalogo->ip = $ip;
        if ($catalogo->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Se ha registrado su ingreso, Bienvenido',
            ]);
        }
    }
}
