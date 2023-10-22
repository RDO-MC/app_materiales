<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BienesInmueblesController;

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
//BIENES INMUEBLES
Route::get('/inmuebles', [BienesInmueblesController::class, 'index'])->name('inmuebles.principal');
Route::get('/inmuebles/crear', [BienesInmueblesController::class, 'create'])->name('inmuebles.crear');
Route::post('/inmuebles', [BienesInmueblesController::class, 'store'])->name('inmuebles.store');
Route::get('/bienes_inmuebles/{id}', [BienesInmueblesController::class, 'show'])->name('bienes_inmuebles.show');
Route::get('inmuebles/{id}/editar', [BienesInmueblesController::class, 'edit'])->name('inmuebles.editar');
Route::put('/inmuebles/{id}/disable', [BienesInmueblesController::class, 'disableUser'])->name('inmuebles.disable');




// Route::post('/role/store','RoleController@createRole')->name('role-store');



