<?php

namespace App\Http\Controllers;
use App\Models\bienes_inmuebles;
use App\Models\bienes_muebles;
use App\Models\activos_nubes;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\asignacion;

use Illuminate\Support\Facades\Session;

class AsignacionController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $usuarios = User::whereRaw("CONCAT(nombre, ' ', a_paterno, ' ', a_materno) LIKE ?", ["%$query%"])
            ->orWhere('num_empleado', 'LIKE', "%$query%")
            ->get();

        $usuarioSeleccionado = null;
        $tipoBien = null;
        $usuarioInactivo = false;

        if ($query && $usuarios->count() > 0) {
            $usuarioSeleccionado = $usuarios->first();
            Session::put('user_id', $usuarioSeleccionado->id);

            if ($usuarioSeleccionado->is_active === 1) {
                $tipoBien = 'Puedes seleccionar el tipo de bien';
            } else {
                $tipoBien = 'Usuario inactivo, no puedes seleccionar el tipo de bien';
                $usuarioInactivo = true;
            }
        }

        return view('asignacion.index', compact('usuarios', 'usuarioSeleccionado', 'tipoBien', 'usuarioInactivo'));
    }

    public function guardarTipoBien(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return back()->withErrors(['No se ha seleccionado un usuario']);
        }

        $tipo_bien = $request->input('tipo_bien');

        if ($tipo_bien === 'bienes_inmuebles') {
            return redirect()->route('asignacion.inmuebles', ['user_id' => $userId]);
        } elseif ($tipo_bien === 'bienes_muebles') {
            return redirect()->route('asignacion.muebles', ['user_id' => $userId]);
        } elseif ($tipo_bien === 'activos_nube') {
            return redirect()->route('nube.principal', ['user_id' => $userId]);
        }
        return redirect()->route('asignacion.inmuebles', ['user_id' => $userId]);
    }

    public function bienesInmueblesPrincipal(Request $request, $user_id)
    {
        $bienes_inmuebles = bienes_inmuebles::where('status', 1)->get();
        $usuarioSeleccionado = User::find($user_id);

        return view('asignacion.inmuebles', [
            'bienes_inmuebles' => $bienes_inmuebles,
            'user_id' => $user_id,
            'usuarioSeleccionado' => $usuarioSeleccionado
        ]);
    }
    public function bienesMueblesPrincipal(Request $request, $user_id)
    {
        $bienes_muebles = bienes_muebles::where('status', 1)->get();
        $usuarioSeleccionado = User::find($user_id);

        return view('asignacion.muebles', [
            'bienes_muebles' => $bienes_muebles,
            'user_id' => $user_id,
            'usuarioSeleccionado' => $usuarioSeleccionado
        ]);
    }
    public function procesarAsignacion(Request $request)
    {
        $user_id = Session::get('user_id');
        $selectedBienesString = $request->input('selected_bienes');
        $selectedBienesArray = explode(',', $selectedBienesString);
    
        if (count($selectedBienesArray) > 0) {
            Session::put('selected_bienes', $selectedBienesArray);
            $usuario = User::find($user_id);
            $tipo_bien = 'bienes_inmuebles'; // Define el tipo de bien aquí
    
            $bienesSeleccionados = bienes_inmuebles::whereIn('id', $selectedBienesArray)->get();
    
            return view('asignacion.formulario')->with([
                'usuarioSeleccionado' => $usuario,
                'bienesSeleccionados' => $bienesSeleccionados,
                'tipo_bien' => $tipo_bien,
            ]);
        } else {
            return back()->withErrors(['error' => 'Debe seleccionar al menos un bien.']);
        }
    }
    
    public function procesarAsignacionMuebles(Request $request)
    {
        $user_id = Session::get('user_id');
        $selectedBienesString = $request->input('selected_bienes');
        $selectedBienesArray = explode(',', $selectedBienesString);
    
        if (count($selectedBienesArray) > 0) {
            Session::put('selected_bienes', $selectedBienesArray);
            $usuario = User::find($user_id);
            $tipo_bien = 'bienes_muebles'; // Define el tipo de bien aquí
    
            $bienesSeleccionados = bienes_muebles::whereIn('id', $selectedBienesArray)->get();
    
            return view('asignacion.formulario')->with([
                'usuarioSeleccionado' => $usuario,
                'bienesSeleccionados' => $bienesSeleccionados,
                'tipo_bien' => $tipo_bien,
            ]);
        } else {
            return back()->withErrors(['error' => 'Debe seleccionar al menos un bien.']);
        }
    }
    public function guardarAsignacion(Request $request)
{
    $request->validate([
        'fecha_de_asignacion' => 'required|date',
        'origen_salida' => 'required|string|max:50',
        'lugar_asignacion' => 'required|string|max:50',
        'estado' => 'required|string|max:50',
        'notas' => 'nullable|string|max:200',
    ]);

    $user_id = Session::get('user_id');
    $selectedBienesArray = Session::get('selected_bienes', []); // Recupera los IDs de los bienes seleccionados

    if (!$user_id) {
        return back()->withErrors(['No se ha seleccionado un usuario']);
    }

    $fecha_de_asignacion = $request->input('fecha_de_asignacion');
    $origen_salida = $request->input('origen_salida');
    $lugar_asignacion = $request->input('lugar_asignacion');
    $estado = $request->input('estado');
    $notas = $request->input('notas');

    foreach ($selectedBienesArray as $bienId) {
        $asignacionData = [
            'users_id' => $user_id,
            'fecha_de_asignacion' => $fecha_de_asignacion,
            'origen_salida' => $origen_salida,
            'lugar_asignacion' => $lugar_asignacion,
            'estado' => $estado,
            'notas' => $notas,
            'status' => '1', // Estado asignado, ajusta esto según tu sistema
        ];

        // Comprueba el tipo de bien seleccionado
        $tipo_bien = $request->input('tipo_bien');

        if ($tipo_bien === 'bienes_inmuebles') {
            $asignacionData['bienes_inmuebles_id'] = $bienId;
            $asignacionData['bienes_muebles_id'] = null;
            $asignacionData['activos_nubes_id'] = null;

            // Campos específicos para bienes inmuebles
            $asignacionData['campo_especifico_inmuebles'] = $request->input('campo_especifico_inmuebles');
        } elseif ($tipo_bien === 'bienes_muebles') {
            $asignacionData['bienes_inmuebles_id'] = null;
            $asignacionData['bienes_muebles_id'] = $bienId;
            $asignacionData['activos_nubes_id'] = null;

            // Campos específicos para bienes muebles
            $asignacionData['campo_especifico_muebles'] = $request->input('campo_especifico_muebles');
        }

        $asignacion = new asignacion($asignacionData);
        $asignacion->save();

        // Actualiza el estado del bien según su tipo
        if ($tipo_bien === 'bienes_inmuebles') {
            $bien = bienes_inmuebles::find($bienId);
        } elseif ($tipo_bien === 'bienes_muebles') {
            $bien = bienes_muebles::find($bienId);
        }

        if ($bien) {
            $bien->status = '3'; // Estado asignado, ajusta esto según tu sistema
            $bien->save();
        }
    }

    // Limpia la sesión después de guardar
    Session::forget('selected_bienes');

    return redirect()->route('asignacion.index')->with('success', 'Asignaciones guardadas exitosamente');
}

} 
