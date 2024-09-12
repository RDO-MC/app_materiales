<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BienesInmueblesController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\BienesMueblesController;
use App\Http\Controllers\ActivosNubeController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\AdministrativoController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AcercaController;
use App\Http\Controllers\SeguridadController;



Route::get('/', function () {
    return view('auth/login');
});
Route::get('/bienes_muebles/{id}', [BienesMueblesController::class, 'show'])->name('bienes.bienes-show');
Route::get('/bienes_inmuebles/{id}', [BienesInmueblesController::class, 'show'])->name('bienes_inmuebles.show');
Route::get('/activos_nube/{id}', [ActivosNubeController::class, 'show'])->name('activos_nube.show');
Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/acerca', [AcercaController::class, 'index'])->name('acerca');
    Route::get('/roles', 'RoleController@selectRole')->name('roles');
    

//usuarios

Route::group(['middleware' => ['role:superadmin']], function() {
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.principal');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.crear');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
    Route::put('usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::put('/usuarios/{id}/disable', [UserController::class, 'disableUser'])->name('usuarios.disable');
});
Route::group(['middleware' => ['role:superadmin']], function() {
//activos 
    Route::get('/activos', [ActivosNubeController::class, 'index'])->name('activos.principal');
    Route::get('/activos/crear', [ActivosNubeController::class, 'create'])->name('activos.crear');
    Route::post('/activos', [ActivosNubeController::class, 'store'])->name('activos.store');
   
    Route::get('/activos/{activos_nube}/editar', [ActivosNubeController::class, 'edit'])->name('activos.editar');
    Route::put('/activos/{activos_nube}', [ActivosNubeController::class, 'update'])->name('activos.update');
    Route::put('/activos/{id}/disable', [ActivosNubeController::class, 'disable'])->name('activos.disable');
    Route::get('/activos/qr', [ActivosNubeController::class, 'imprimirQR'])->name('activos.qr');
    
});

Route::group(['middleware' => ['role:superadmin']], function() {
//muebles
    Route::get('/muebles', [BienesMueblesController::class, 'index'])->name('muebles.principal');
    Route::get('/muebles/crear', [BienesMueblesController::class, 'create'])->name('muebles.crear');
    Route::post('/muebles', [BienesMueblesController::class, 'store'])->name('muebles.store');
   
    Route::get('/muebles/{bienes_muebles}/editar', [BienesMueblesController::class, 'edit'])->name('muebles.editar');
    Route::put('/muebles/{bienes_muebles}', [BienesMueblesController::class, 'update'])->name('muebles.update');
    Route::put('/muebles/{id}/disable', [BienesMueblesController::class, 'disablemuebles'])->name('muebles.disable');
    Route::get('/muebles/qr', [BienesMueblesController::class, 'imprimirQR'])->name('muebles.qr');
    
});


Route::group(['middleware' => ['role:superadmin']], function() {
    //BIENES INMUEBLES
    Route::get('/inmuebles', [BienesInmueblesController::class, 'index'])->name('inmuebles.principal');
    Route::get('/inmuebles/crear', [BienesInmueblesController::class, 'create'])->name('inmuebles.crear');
    Route::post('/inmuebles', [BienesInmueblesController::class, 'store'])->name('inmuebles.store');

    Route::get('inmuebles/{id}/editar', [BienesInmueblesController::class, 'edit'])->name('inmuebles.editar');
    Route::put('inmuebles/{id}', [BienesInmueblesController::class, 'update'])->name('inmuebles.update');
    Route::put('/inmuebles/{id}/disable', [BienesInmueblesController::class, 'disableUser'])->name('inmuebles.disable');
    Route::get('/inmuebles/qr', [BienesInmueblesController::class, 'imprimirQR'])->name('inmuebles.qr');
});

Route::group(['middleware' => ['role:superadmin']], function() {
    //ASIGNACIONES
    Route::get('/asignacion', [AsignacionController::class, 'index'])->name('asignacion.index');
    Route::post('/asignacion/guardar-tipo-bien', [AsignacionController::class, 'guardarTipoBien'])->name('asignacion.guardarTipoBien');
    Route::GET('/asignacion/inmuebles/{user_id}', [AsignacionController::class, 'bienesInmueblesPrincipal'])->name('asignacion.inmuebles');
    Route::GET('/asignacion/muebles/{user_id}', [AsignacionController::class, 'bienesMueblesPrincipal'])->name('asignacion.muebles');
    Route::GET('/asignacion/nube/{user_id}', [AsignacionController::class, 'activosNubesPrincipal'])->name('asignacion.nubes');
    Route::match(['get', 'post'], '/asignacion/proceso', [AsignacionController::class, 'procesarAsignacion'])->name('asignacion.proceso');
    Route::match(['get', 'post'], '/asignacion/proceso1', [AsignacionController::class, 'procesarAsignacionMuebles'])->name('asignacion.proceso1');
    Route::match(['get', 'post'], '/asignacion/proceso2', [AsignacionController::class, 'procesarAsignacionNubes'])->name('asignacion.proceso2');
    Route::get('/asignacion/formulario', [AsignacionController::class,'procesarAsignacion'])->name('asignacion.formulario');
    Route::post('/asignacion/guardar', [AsignacionController::class, 'guardarAsignacion'])->name('asignacion.guardar');
    Route::get('/asignacion/devoluciones', [AsignacionController::class, 'devolucion'])->name('asignacion.devoluciones')->middleware('auth');
    Route::post('/asignacion/devolver/{asignacionId}', [AsignacionController::class, 'devolver'])->name('asignacion.devolver');
    Route::post('/asignacion/devoluciones/search', [AsignacionController::class, 'searchAsignaciones'])->name('asignacion.search');
    
    Route::get('/asignacion/pdf', [AsignacionController::class, 'generatePDF'])->name('asignacion.pdf');
  
});
Route::group(['middleware' => ['role:superadmin']], function() {
    //reportes
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
    Route::post('/reportes/generar', [ReportesController::class, 'generar'])->name('reportes.generar');
    Route::post('/generar-pdf', [ReportesController::class, 'generarPDF'])->name('generar-pdf');
});
Route::group(['middleware' => ['auth']], function () {
    //prestamos
    Route::get('/prestamos', [PrestamosController::class, 'index'])->name('prestamos.principal');
    Route::get('/prestamos/crear', [PrestamosController::class, 'create'])->name('prestamos.crear');
    Route::post('/prestamos', [PrestamosController::class, 'store'])->name('prestamos.store');
    Route::post('/prestamos/devolver/{prestamoId}', [PrestamosController::class, 'devolver'])->name('prestamos.devolver');
    Route::get('/prestamos/devoluciones', [PrestamosController::class, 'devolucion'])->name('prestamos.devoluciones')->middleware('auth');
    Route::post('/prestamos/devoluciones/search', [PrestamosController::class, 'search'])->name('prestamos.search');
    Route::get('/prestamos/pdf', [PrestamosController::class, 'generatePDF'])->name('prestamos.pdf');
    
})->middleware('role:superadmin|seguridad');

Route::group(['middleware' => ['role:superadmin']], function() {
//actividades y registros
    Route::get('/actividades/registros', [RegistroController::class, 'index'])->name('actividades.registros');
    Route::get('/actividades/actividades', [ActividadesController::class, 'index'])->name('actividades.actividades');

});

Route::group(['middleware' => ['role:administrativo']], function() {
    Route::get('prestamos/materiales', [AdministrativoController::class, 'materialesAsignados'])->name('prestamos.materiales');
    Route::get('/prestamos/asignacion-prestamo/{id}', [AdministrativoController::class, 'create'])->name('prestamos.asignacion-prestamo');
    Route::get('/buscar-usuario/{numeroEmpleado}', [AdministrativoController::class, 'buscarUsuario'])->name('buscar-usuario');
    Route::post('/administrativo/guardar', [AdministrativoController::class, 'guardarPrestamo'])->name('administrativo.guardarPrestamo');
    Route::put('/administrativo/realizarDevolucion/{id}', [AdministrativoController::class, 'realizarDevolucion'])->name('administrativo.realizarDevolucion');

});
Route::group(['middleware' => ['auth']], function () {
    Route::get('prestamos-amd', [MaterialesController::class, 'materialesPrestados'])->name('prestamos-amd');
    
})->middleware('role:administrativo|seguridad');

Route::group(['middleware' => ['role:seguridad']], function() {
    Route::get('/seguridad/scanear', [SeguridadController::class, 'create'])->name('seguridad.scanear');
    Route::post('/seguridad', [SeguridadController::class, 'store'])->name('seguridad.store');

});


Route::group(['middleware' => ['role:comun']], function() {
    Route::get('principal', [MaterialesController::class, 'materialesAsignados'])->name('principal');
});