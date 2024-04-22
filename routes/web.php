<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SistemaTurnos\DependenciaController;
use App\Http\Controllers\SistemaTurnos\AsistenciaController;
use App\Http\Controllers\SistemaTurnos\AsignacionController;
use App\Http\Controllers\SistemaTurnos\CatalogoController;
use App\Http\Controllers\SistemaTurnos\VacacionController;
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
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('dependencia', DependenciaController::class);
});


Route::post('/guardar_campos_requerimiento', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_ingreso'])->name('guardar_campos_requerimiento');
Route::post('/guardar_campos_salida', [App\Http\Controllers\SistemaTurnos\AsistenciaController::class, 'marcaje_salida'])->name('guardar_campos_salida');
//asingaciones
Route::get('/index_asignacion', [App\Http\Controllers\SistemaTurnos\AsignacionController::class, 'asignacion'])->name('index');
Route::get('/index_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'catalogo'])->name('index');
Route::get('/lista_catalogo', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'lista_catalogo'])->name('lista_catalogo');
Route::post('/listar', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'listar'])->name('listar');
Route::get('/crear', [App\Http\Controllers\SistemaTurnos\CatalogoController::class, 'crear'])->name('crear');
//Vacaciones
Route::get('/index_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'vista'])->name('index_vacaciones');
Route::get('/crear_vacaciones', [App\Http\Controllers\SistemaTurnos\VacacionController::class, 'crear_vacaciones'])->name('crear_vacaciones');
