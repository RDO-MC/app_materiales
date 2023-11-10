<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Asignacion;
use App\Models\Prestamos;
use Illuminate\Http\Request;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;

class AdministrativoController extends Controller
{
    public function materialesAsignados()
    {
        $user = Auth::user();
        // Filtra las asignaciones con estado 1
        $asignaciones = Asignacion::where('users_id', $user->id)->where('status', 1)->get();
        return view('prestamos.materiales', compact('asignaciones'));
    }

    public function create($id)
{
    $users = User::where('is_active', 1)->get();
    $asignacion = Asignacion::findOrFail($id);
    $usuario = User::find($asignacion->users_id); // Agrega esta línea para obtener el usuario

    return view('prestamos.asignacion-prestamo', compact('asignacion', 'users', 'usuario'));
}


    public function buscarUsuario($numeroEmpleado)
    {
        // Realiza una consulta para buscar al usuario por número de empleado
        $user = User::where('num_empleado', $numeroEmpleado)->first();

        // Verifica si se encontró el usuario
        if ($user) {
            // Devuelve la información del usuario en formato JSON
            return response()->json([
                'nombre' => $user->nombre,
                'apellidos' => $user->a_paterno,
            ]);
        } else {
            // Devuelve un mensaje de error si el usuario no se encuentra
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    public function guardarPrestamo(Request $request)
    {
        $request->validate([
            'numero_empleado' => 'required',
            'lugar_de_prestamo' => 'required',
            'notas' => 'nullable',
            'observaciones' => 'nullable',
            'estado' => 'required',
            'fecha_de_prestamo' => 'required|date',
            'fecha_de_devolucion' => 'required|date',
        ]);

        try {
            // Verifica si la asignación es de bienes muebles antes de proceder
            $asignacion = Asignacion::findOrFail($request->id_bien);
            
            if ($asignacion->bienes_muebles_id) {
                $prestamo = new Prestamos();
                $prestamo->bienes_muebles_id = $asignacion->bienes_muebles_id;
                $prestamo->bienes_inmuebles_id = null;
                $prestamo->activos_nubes_id = null;
                
                $prestamo->users_id = $request->usuario_id;
                $prestamo->lugar_de_prestamo = $request->lugar_de_prestamo;
                $prestamo->notas = $request->notas;
                $prestamo->observaciones = $request->observaciones;
                $prestamo->estado = $request->estado;
                $prestamo->fecha_de_prestamo = $request->fecha_de_prestamo;
                $prestamo->fecha_de_devolucion = $request->fecha_de_devolucion;
                $prestamo->save();

                return redirect()->route('prestamos.materiales')->with('success', 'Préstamo creado exitosamente');
            } else {
                // Manejar el caso en que la asignación no es de bienes muebles
                return redirect()->back()->with('error', 'La asignación no es de bienes muebles.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el préstamo: ' . $e->getMessage());
        }
    }
}    
