<?php
namespace App\Http\Controllers;
use App\Models\prestamos;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;

class PrestamosController extends Controller
{
    public function index()
    {
        $prestamos = prestamos::all(); // Recupera todos los préstamos desde tu modelo Prestamo
    return view('prestamos.principal', compact('prestamos'));
    }
 
    public function create()
    {
        
        $users = User::where('is_active', 1)->get();
        $bienes_muebles = bienes_muebles::where('status', 1)->get();
        $bienes_inmuebles = bienes_inmuebles::where('status', 1)->get();
        return view('prestamos.crear', compact('bienes_muebles', 'users', 'bienes_inmuebles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'lugar_de_prestamo' => 'required',
            'fecha_de_prestamo' => 'required',
            'estado' => 'required',
            'fecha_de_devolucion' => 'required',
            'tipo_bien' => 'required',
        ]);
    
        $tipoBien = $request->input('tipo_bien');
    
        // Obtén los materiales seleccionados en un arreglo
        $materialesSeleccionados = $request->input($tipoBien);
    
        // Itera sobre los materiales seleccionados y crea un registro por cada uno
        foreach ($materialesSeleccionados as $materialId) {
            $prestamo = new Prestamos();
            $prestamo->users_id = $request->input('usuario');
            $prestamo->lugar_de_prestamo = $request->input('lugar_de_prestamo');
            $prestamo->fecha_de_prestamo = $request->input('fecha_de_prestamo');
            $prestamo->estado = $request->input('estado');
            $prestamo->fecha_de_devolucion = $request->input('fecha_de_devolucion');
            $prestamo->observaciones = $request->input('observaciones');
            $prestamo->status = $request->input('status', 1);
    
            // Asigna el material actual
            if ($tipoBien === 'bienes_muebles') {
                $prestamo->bienes_muebles_id = $materialId;
                $prestamo->bienes_inmuebles_id = null;
    
                // Actualiza el estado del bien mueble a 2
                bienes_muebles::where('id', $materialId)->update(['status' => 2]);
            } elseif ($tipoBien === 'bienes_inmuebles') {
                $prestamo->bienes_inmuebles_id = $materialId;
                $prestamo->bienes_muebles_id = null;
    
                // Actualiza el estado del bien inmueble a 2
                bienes_inmuebles::where('id', $materialId)->update(['status' => 2]);
            }
    
            $prestamo->save();
        }
    
        return redirect()->route('prestamos.principal')->with('success', 'Préstamos creados correctamente');
    }

    public function devolver(Request $request, $prestamoId)
{
    $prestamo = prestamos::find($prestamoId);

    if (!$prestamo) {
        return redirect()->route('prestamos.principal')->with('error', 'Préstamo no encontrado');
    }

    $tipoBien = $prestamo->bienes_muebles_id ? 'muebles' : 'inmuebles';

    if ($tipoBien === 'muebles') {
        bienes_muebles::where('id', $prestamo->bienes_muebles_id)->update(['status' => 1]);
    } elseif ($tipoBien === 'inmuebles') {
        bienes_inmuebles::where('id', $prestamo->bienes_inmuebles_id)->update(['status' => 1]);
    }

    // Elimina el registro de préstamo de la base de datos
    $prestamo->delete();

    return redirect()->route('prestamos.principal')->with('success', 'Préstamo devuelto y eliminado correctamente');
}
}