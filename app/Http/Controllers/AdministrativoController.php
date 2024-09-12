<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\asignacion;
use App\Models\prestamos;
use Illuminate\Http\Request;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;
use App\Models\activos_nube;///////////////////////////////////
use App\Models\actividades;////////////////////////////////////////////////////
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Log;

class AdministrativoController extends Controller
{
    public function materialesAsignados()
    {
        $user = Auth::user();
        
        // Recupera las asignaciones con estado 1 o 2
        $asignaciones = asignacion::where('users_id', $user->id)->whereIn('status', [1, 2])->get();
        
        return view('prestamos.materiales', compact('asignaciones'));
    }
    public function create($id)
{
    $users = User::where('is_active', 1)->get();
    $asignacion = asignacion::findOrFail($id);
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
        // Verifica si la asignación es de bienes muebles, inmuebles o activos de nubes
        $asignacion = Asignacion::findOrFail($request->id_bien);

        $prestamo = new prestamos();

        if ($asignacion->bienes_muebles_id) {
            $prestamo->bienes_muebles_id = $asignacion->bienes_muebles_id;
            $prestamo->bienes_inmuebles_id = null;
            $prestamo->activos_nubes_id = null;
            $tipoBien = 'BIENES_MUEBLES';
        } elseif ($asignacion->bienes_inmuebles_id) {
            $prestamo->bienes_inmuebles_id = $asignacion->bienes_inmuebles_id;
            $prestamo->bienes_muebles_id = null;
            $prestamo->activos_nubes_id = null;
            $tipoBien = 'BIENES_INMUEBLES';
        } elseif ($asignacion->activos_nubes_id) {
            // Agrega aquí la lógica para activos de nubes si es necesario
            $tipoBien = 'ACTIVOS_NUBES';
        } else {
            // Manejar otros casos si es necesario
            $tipoBien = 'DESCONOCIDO';
        }

        // Busca al usuario por número de empleado
        $usuario = User::where('num_empleado', $request->numero_empleado)->first();

        // Verifica si se encontró el usuario
        if ($usuario) {
            $prestamo->users_id = $usuario->id;
        } else {
            // Maneja el caso en que el usuario no se encuentra
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        $prestamo->lugar_de_prestamo = $request->lugar_de_prestamo;
        $prestamo->notas = $request->notas;
        $prestamo->observaciones = $request->observaciones;
        $prestamo->estado = $request->estado;
        $prestamo->fecha_de_prestamo = $request->fecha_de_prestamo;
        $prestamo->fecha_de_devolucion = $request->fecha_de_devolucion;
        $prestamo->status = 1;
        $prestamo->save();

        // Actualiza el estado de la asignación a 2
        $asignacion->status = 2;
        $asignacion->save();

        // Recupera detalles adicionales según el tipo de bien prestado
        $detalleMaterial = '';
        if ($tipoBien === 'BIENES_MUEBLES') {
            $material = bienes_muebles::find($prestamo->bienes_muebles_id);
            $detalleMaterial = ', MATERIAL PRESTADO Con CVE Inventario Interno: ' . $material->cve_inventario_interno;
        } elseif ($tipoBien === 'BIENES_INMUEBLES') {
            $material = bienes_inmuebles::find($prestamo->bienes_inmuebles_id);
            $detalleMaterial = ', MATERIAL PRESTADO Con Num. Escritura Propiedad: ' . $material->num_escritura_propiedad;
        } 

        // Registra la actividad del préstamo
        $accion = 'Préstamo de : ' . $tipoBien . ' ,AL USUARIO : ' . $usuario->nombre . ' ' . $usuario->a_paterno . ' CON #EMPLEADO : ' . $usuario->num_empleado . ' CAMPUS : ' . $request->campus . $detalleMaterial;
        $this->registrarActividad($accion);

        return redirect()->route('prestamos.materiales')->with('success', 'Préstamo creado exitosamente');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al crear el préstamo: ' . $e->getMessage());
    }
}
public function realizarDevolucion(Request $request, $id)
{
    try {
        // Obtén la asignación por su ID
        $asignacion = Asignacion::findOrFail($id);
        // Cambia el estado de la asignación a 1 (disponible)
        $asignacion->status = 1;
        $asignacion->save();
        // Inicializa las variables para identificar el tipo de bien
        $bienesMueblesId = $asignacion->bienes_muebles_id;
        $bienesInmueblesId = $asignacion->bienes_inmuebles_id;
        // Busca el préstamo basado en el tipo de bien
        $prestamo = Prestamos::where('bienes_muebles_id', $bienesMueblesId)
            ->orWhere('bienes_inmuebles_id', $bienesInmueblesId)
            ->first();
        // Verifica si se encontró el préstamo
        if ($prestamo) {
            // Cambia el estado del préstamo a 0 (devuelto) y agrega observaciones
            $prestamo->update([
                'status' => 0,
                'observaciones' => $request->observaciones,
            ]);

            // Obtiene información del usuario
            $usuario = User::find($prestamo->users_id);

            // Obtiene información del material prestado
            $material = $asignacion->bienes_muebles_id
                ? bienes_muebles::find($asignacion->bienes_muebles_id)
                : bienes_inmuebles::find($asignacion->bienes_inmuebles_id);

            // Genera el PDF con la información
            $pdf = PDF::loadView('prestamos.comprobante-pdf', [
                'usuario' => $usuario,
                'material' => $material,
                'tipoBien' => $asignacion->bienes_muebles_id ? 'bienes_muebles' : 'bienes_inmuebles',
                'fecha' => now()->format('d/m/Y'),
            ]);

            // Elimina el registro de préstamo
            $prestamo->delete();

            // Registra la actividad de devolución
            $tipoBien = $asignacion->bienes_muebles_id ? 'bienes_muebles' : 'bienes_inmuebles';
            $detalleMaterial = $asignacion->bienes_muebles_id
                ? ' (CVE Inventario Interno: ' . $material->cve_inventario_interno . ')'
                : ' (Num. Escritura Propiedad: ' . $material->num_escritura_propiedad . ')';

            $accion = ' Devolucion de Prestamo :' . strtoupper($tipoBien)
                . ' ' . ' ,DEVUELVE  :' . $usuario->nombre . ' ' . $usuario->a_paterno
                . ' ' . '  ,CON #EMPLEADO  :' . $usuario->num_empleado
                . ' ' . ',DATOS DE MATERIAL DEVUELTO :' . $detalleMaterial;

            $this->registrarActividad($accion);

            // Descarga el PDF
            return $pdf->download('comprobante-devolucion.pdf');
        } else {
            // Maneja el caso en que el préstamo no se encuentra
            return redirect()->back()->with('error', 'Préstamo no encontrado.');
        }
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Error al realizar la devolución: ' . $e->getMessage());
    }
}



//////////////////////////////////////////////////////////////////////////////////////////
private function registrarActividad($accion, $detalles = [])
{
    actividades::create([
        'users_id' => auth()->user()->id,
        'actividad' => $accion,
        'fecha_hora' => now(),
        // Puedes agregar más información si es necesario
    ]);
}
}