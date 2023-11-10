<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Asignacion;
use App\Models\Prestamos;
use App\Models\bienes_inmuebles;
use App\Models\bienes_muebles;
use App\Models\activos_nube;

use Illuminate\Http\Request;

class MaterialesController extends Controller
{
    public function materialesAsignados()
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        // Filtra las asignaciones con estado 1
        $asignaciones = Asignacion::where('users_id', $user->id)->where('status', 1)->get();

        // Filtra los préstamos con estado 1
        $prestamos = Prestamos::where('users_id', $user->id)->where('status', 1)->get();

        return view('principal', compact('asignaciones', 'prestamos'));
    }
    
}
