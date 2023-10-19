<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.principal');
Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.crear');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
Route::put('usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');





// Route::post('/role/store','RoleController@createRole')->name('role-store');



