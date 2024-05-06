<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SistemaTurnos\DependenciaController;
use App\Http\Controllers\SistemaTurnos\AsistenciaController;
use App\Http\Controllers\SistemaTurnos\AsignacionController;
use App\Http\Controllers\SistemaTurnos\CatalogoController;
use App\Http\Controllers\SistemaTurnos\VacacionController;
use App\Http\Controllers\SistemaTurnos\RrhhController;
use App\Http\Controllers\SistemaTurnos\ReporteriaController;
use App\Http\Controllers\SistemaTurnos\UsuariosController;
use App\Http\Controllers\SistemaTurnos\CatalogoRolController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('dependencia', DependenciaController::class);
});
//usuarios
Route::get('/index_usuarios', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'usuarios'])->name('index');
Route::post('/listar_usuarios', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'listar_usuarios'])->name('listar_usuarios');
Route::get('/asignacion_roles/{id?}', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'asignacion_rol'])->name('detalle_rol_asignacion');

//marcaje usuario
Route::post('/guardar_campos_requerimiento', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_ingreso'])->name('guardar_campos_requerimiento');
Route::post('/guardar_campos_salida', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_salida'])->name('guardar_campos_salida');
//asingaciones
Route::get('/index_asignacion', [App\Http\Controllers\SistemaTurnos\AsignacionController::class, 'asignacion'])->name('index');
//Catalogos
Route::get('/index_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'catalogo'])->name('index');
Route::get('/lista_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'lista_catalogo'])->name('lista_catalogo');
Route::post('/listar_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'listar'])->name('listar_catalogo');
Route::post('/guardar_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'guardar_catalogo'])->name('guardar_catalogo');
Route::post('/inactivar_catalogo_items/{id?}', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'inactivar_catalogo_items'])->name('inactivar_catalogo_items');
//Catalogos Roles
Route::get('/index_catalogo_roles', [App\Http\Controllers\SistemaTurnos\CatalogoRolController::class, 'vista'])->name('index_catalogo_roles');


//Vacaciones
Route::get('/index_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'vista'])->name('index_vacaciones');
Route::get('/crear_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'crear_vacaciones'])->name('crear_vacaciones');
Route::get('/filtar_persona', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'filtar_datos_persona'])->name('filtar_persona');
//Recursos Humanos
Route::get('/index_listar', [App\Http\Controllers\SistemaTurnos\RrhhController::class, 'listar'])->name('index_listar');
//Reporteria
Route::get('/index_reporte', [App\Http\Controllers\SistemaTurnos\ReporteriaController::class, 'vista'])->name('index');
