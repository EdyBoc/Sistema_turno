<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SistemaTurnos\AsistenciaController;
use App\Http\Controllers\SistemaTurnos\AsignacionController;
use App\Http\Controllers\SistemaTurnos\CatalogoController;
use App\Http\Controllers\SistemaTurnos\VacacionController;
use App\Http\Controllers\SistemaTurnos\RrhhController;
use App\Http\Controllers\SistemaTurnos\ReporteriaController;
use App\Http\Controllers\SistemaTurnos\UsuariosController;
use App\Http\Controllers\SistemaTurnos\CatalogoRolController;
use App\Http\Controllers\SistemaTurnos\PerfilController;
use App\Http\Controllers\SistemaTurnos\AutorizacionController;


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
});
//usuarios
Route::get('/index_usuarios', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'usuarios'])->name('index_usuario');
Route::post('/listar_usuarios', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'listar_usuarios'])->name('listar_usuarios');
Route::get('/asignacion_roles/{id?}', [App\Http\Controllers\SistemaTurnos\UsuariosController::class, 'asignacion_rol'])->name('detalle_rol_asignacion');
//marcaje usuario
Route::post('/guardar_campos_requerimiento', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_ingreso'])->name('guardar_campos_requerimiento');
Route::post('/guardar_campos_salida', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_salida'])->name('guardar_campos_salida');
//asingaciones
Route::get('/index_asignacion', [App\Http\Controllers\SistemaTurnos\AsignacionController::class, 'asignacion'])->name('index_asignacion');
//Catalogos
Route::get('/index_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'catalogo'])->name('index');
Route::get('/index_dependencia', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'view_catalogo_dependencia'])->name('index_dependencia');
Route::get('/index_turno', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'view_catalogo_turno'])->name('index_turno');
Route::post('/guardar_turno', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'guardar_catalogo_turno'])->name('guardar_turno');
Route::post('/guardar_dependencia', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'guardar_catalogo_dependencia'])->name('guardar_dependencia');
//Catalogos Roles
Route::get('/index_catalogo_roles', [App\Http\Controllers\SistemaTurnos\CatalogoRolController::class, 'vista'])->name('index_catalogo_roles');
Route::post('/guardar_catalogo_rol', [App\Http\Controllers\SistemaTurnos\CatalogoRolController::class, 'guardar_catalogo_rol'])->name('guardar_catalogo_rol');
//Vacaciones
Route::get('/index_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'vista'])->name('index_vacaciones');
Route::get('/crear_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'crear_vacaciones'])->name('crear_vacaciones');
Route::get('/filtar_persona', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'filtar_datos_persona'])->name('filtar_persona');
//Recursos Humanos
Route::get('/index_listar', [App\Http\Controllers\SistemaTurnos\RrhhController::class, 'listar'])->name('index_listar');
Route::get('/index_alta', [App\Http\Controllers\SistemaTurnos\RrhhController::class, 'view_nueva_alta'])->name('index_alta');
Route::get('/lista_personas', [App\Http\Controllers\SistemaTurnos\RrhhController::class, 'lista_personas'])->name('lista_personas');
Route::post('/guardar_altas', [App\Http\Controllers\SistemaTurnos\RrhhController::class, 'guardar_personas_altas'])->name('guardar_altas');
//Reporteria
Route::get('/index_reporte', [App\Http\Controllers\SistemaTurnos\ReporteriaController::class, 'vista'])->name('index');
Route::post('/reporte_horas', [App\Http\Controllers\SistemaTurnos\ReporteriaController::class, 'horasSalidaChart'])->name('reporte_horas');
//Perfil del trabajador
Route::get('/index_perfil', [App\Http\Controllers\SistemaTurnos\PerfilController::class, 'view_perfil'])->name('index_perfil');
Route::get('/index_horas_extras', [App\Http\Controllers\SistemaTurnos\PerfilController::class, 'view_horas_extras'])->name('index_horas_extras');
Route::get('/index_solicitudes', [App\Http\Controllers\SistemaTurnos\PerfilController::class, 'view_solicitudes'])->name('index_solicitudes');
Route::post('/guardar_solicitud', [App\Http\Controllers\SistemaTurnos\PerfilController::class, 'guardar_solicitud'])->name('guardar_solicitud');
Route::post('/guardar_horas', [App\Http\Controllers\SistemaTurnos\PerfilController::class, 'guardar_reporte_horas'])->name('guardar_horas');
//Autorizaciones


Route::get('/autorizacion_horas', [App\Http\Controllers\SistemaTurnos\AutorizacionController::class, 'view_autorizacion_horas'])->name('autorizacion_horas');
Route::get('/autorizacion_solicitud', [App\Http\Controllers\SistemaTurnos\AutorizacionController::class, 'view_autorizacio_solicitudxtras'])->name('autorizacion_solicitud');
Route::get('/index_autorizacion', [App\Http\Controllers\SistemaTurnos\AutorizacionController::class, 'view_autorizacion'])->name('index_autorizacion');
