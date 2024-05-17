<?php

namespace App\Http\Controllers\SistemaTurnos;


use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\Encrypter;
use App\Http\Controllers\Controller;
use App\Models\baseModel;
use App\Models\SistemaTurnos\Vw_usuarios;
use App\Models\SistemaTurnos\Catalogo_rol;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Response;
use Storage;
use View;


class UsuariosController extends Controller
{

    protected $pageData;
    protected $encrypter;

    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
        $this->pageData = [];
    }



    public function usuarios(Request $request)
    {
        return view('sistemaTurnos.usuario.index_usuario');
    }

    public function listar_usuarios(request $request)
    {
        //DataTable contador de renderizacion
        $dataTablesResponse['draw'] = intval($request->draw);

        //obtengo datos de paginacion
        $limit = ($request->length != '') ? $request->length : false;
        $offset = $request->start;
        $order = $request->order;

        $tableCols = array(
            'No.',
            'Nombre',
            'Correo Electronico',
            'Rol',
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
            'Nombre',
            'Correo Electronico',
            'Rol',
        ];


        if (isset($request->estado) && $request->estado !== '') {
            $query = Vw_usuarios::query()->where('esta_activo', filter_var($request->estado, FILTER_VALIDATE_BOOLEAN));
        } else {

            $query = Vw_usuarios::query();
        }

        // Verificar si se proporciona un avanzado de búsqueda
        if (isset($request->avanzado) && $request->avanzado != '') {
            // Aplicar la condición de búsqueda si se proporciona un avanzado
            $query->where(function ($query) use ($request) {
                $avanzado = $request->avanzado;
                $query->where('name', 'like', "%$avanzado%")
                    ->orWhere('email', 'like', "%$avanzado%");
            });
        }

        // Obtener los resultados
        $registros = $query->orderBy('name', 'desc')->get();

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
                    href="' . route("detalle_rol_asignacion", ['id' => encrypt($item->id)]) . '"
                    > <i class="fas fa-edit listaIcon"></i></a>';

            $name = $item->name;
            $email = $item->email;
            $nombre_rol = $item->nombre_rol;
            $estado = $item->estado;

            $results[] = [
                '<div style="text-align:center;" class="orden">' . $contador . '</div>',
                '<div style="text-align:center;" class="orden">' . $name . '</div>',
                '<div style="text-align:center;" class="orden">' . $email . '</div>',
                '<div style="text-align:center;" class="orden">' . $nombre_rol . '</div>',
                '<div style="text-align:center;" class="orden">' . $estado . '</div>',
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

    public function asignacion_rol(Request $request, $encryptedId)
    {
        $id = decrypt($encryptedId);
        $usuario = Vw_usuarios::where('id', $id)->first();
        $this->pageData['usuario'] = $usuario;


        $estado = [
            true => 'Activo',
            false => 'Inactivo'
        ];
        $this->pageData['estado'] = $estado;

        $rol = Catalogo_rol::pluck('nombre', 'id_catalogo_rol');

        $this->pageData['rol'] = $rol;

        return view('sistemaTurnos.usuario.detalle_rol_asignacion', $this->pageData);
    }
}
