<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BienesInmueblesController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\BienesMueblesController;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/roles', 'RoleController@selectRole')->name('roles');
//usuarios
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.principal');
Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.crear');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
Route::put('usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
Route::put('/usuarios/{id}/disable', [UserController::class, 'disableUser'])->name('usuarios.disable');

//muebles
Route::get('/muebles', [BienesMueblesController::class, 'index'])->name('muebles.principal');
Route::get('/muebles/crear', [BienesMueblesController::class, 'create'])->name('muebles.crear');
Route::post('/muebles', [BienesMueblesController::class, 'store'])->name('muebles.store');
Route::get('/bienes_muebles/{id}', [BienesMueblesController::class, 'show'])->name('bienes_muebles.show');
Route::get('/muebles/{bienes_muebles}/editar', [BienesMueblesController::class, 'edit'])->name('muebles.editar');
Route::put('/muebles/{bienes_muebles}', [BienesMueblesController::class, 'update'])->name('muebles.update');
Route::put('/muebles/{id}/disable', [BienesMueblesController::class, 'disablemuebles'])->name('muebles.disable');

//BIENES INMUEBLES
Route::get('/inmuebles', [BienesInmueblesController::class, 'index'])->name('inmuebles.principal');
Route::get('/inmuebles/crear', [BienesInmueblesController::class, 'create'])->name('inmuebles.crear');
Route::post('/inmuebles', [BienesInmueblesController::class, 'store'])->name('inmuebles.store');
Route::get('/bienes_inmuebles/{id}', [BienesInmueblesController::class, 'show'])->name('bienes_inmuebles.show');
Route::get('inmuebles/{id}/editar', [BienesInmueblesController::class, 'edit'])->name('inmuebles.editar');
Route::put('inmuebles/{id}', [BienesInmueblesController::class, 'update'])->name('inmuebles.update');
Route::put('/inmuebles/{id}/disable', [BienesInmueblesController::class, 'disableUser'])->name('inmuebles.disable');

//ASIGNACIONES
Route::get('/asignacion', [AsignacionController::class, 'index'])->name('asignacion.index');
Route::GET('/asignacion/guardar-tipo-bien', [AsignacionController::class, 'guardarTipoBien'])->name('asignacion.guardarTipoBien');
Route::GET('/asignacion/inmuebles/{user_id}', [AsignacionController::class, 'bienesInmueblesPrincipal'])->name('asignacion.inmuebles');
Route::GET('/asignacion/muebles/{user_id}', [AsignacionController::class, 'bienesMueblesPrincipal'])->name('asignacion.muebles');
Route::get('/asignacion/formulario', [AsignacionController::class, 'procesarAsignacion'])->name('asignacion.formulario');
Route::match(['get', 'post'], '/asignacion/proceso', [AsignacionController::class, 'procesarAsignacion'])->name('asignacion.proceso');
Route::post('/asignacion/guardar', [AsignacionController::class, 'guardarAsignacion'])->name('asignacion.guardar');
