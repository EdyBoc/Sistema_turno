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
        return view('sistemaTurnos.catalogos.roles.index');
    }




    public function listar(Request $request)
    {
        $query = Catalogo_rol::query();

        if ($request->has('estado')) {
            $query->where('esta_activo', filter_var($request->estado, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->has('avanzado')) {
            $avanzado = $request->avanzado;
            $query->where(function ($query) use ($avanzado) {
                $query->where('nombre', 'like', "%$avanzado%")
                    ->orWhere('descripcion', 'like', "%$avanzado%");
            });
        }

        $registros = $query->orderBy('nombre', 'desc')->paginate($request->length);

        $data = $registros->map(function ($item, $key) {
            $linkEditar = '<a title="Editar " data-toggle="tooltip" data-original-title="Prioridad" class="btnUPD" href="#" onclick="modalEditarCatalogo(' . $item->id_catalogo_rol . ')"><i class="fas fa-edit listaIcon"></i></a>';

            return [
                '<div style="text-align:center;" class="orden">' . ($key + 1) . '</div>',
                '<div style="text-align:center;" class="orden">' . $item->nombre . '</div>',
                '<div style="text-align:center;" class="orden">' . $item->descripcion . '</div>',
                '<div style="text-align:center; width:100%;">' . $linkEditar . '</div>'
            ];
        });

        return response()->json([
            'draw' => intval($request->draw),
            'data' => $data,
            'recordsTotal' => $registros->total(),
            'recordsFiltered' => $registros->total(),
        ]);
    }
}
