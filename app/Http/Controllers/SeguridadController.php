<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\prestamos;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;  
use Illuminate\Support\Facades\View;
use App\Models\actividades;////////////////////////////////////////// //////////
use Illuminate\Support\Facades\Log;   

class SeguridadController extends Controller
{
    public function create()
    {
        $users = User::where('is_active', 1)->get();
        
        $bienes_muebles = bienes_muebles::where('status', 1)->get();
        $bienes_inmuebles = bienes_inmuebles::where('status', 1)->get();
        return view('seguridad.scanear', compact('bienes_muebles', 'users', 'bienes_inmuebles'));
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
            'codigo_qr' => 'required|array', // Asegúrate de que sea un array
        ]);
    
        try {
            $tipoBien = $request->input('tipo_bien');
            $materialIds = [];
    
            // Obtener los IDs de las URLs
            foreach ($request->input('codigo_qr') as $url) {
                $parts = explode('/', $url);
                $id = end($parts);
                $materialIds[] = $id;
            }
    
            $usuario = User::find($request->input('usuario'));
    
            // Registrar la actividad
            $this->registrarActividad("Préstamo de: $tipoBien al usuario: {$usuario->nombre} {$usuario->a_paterno} con #empleado: {$usuario->num_empleado} Campus: {$usuario->campus}");
    
            // Crear los préstamos
            foreach ($materialIds as $materialId) {
                $prestamo = new Prestamos();
                $prestamo->users_id = $request->input('usuario');
                $prestamo->lugar_de_prestamo = $request->input('lugar_de_prestamo');
                $prestamo->fecha_de_prestamo = $request->input('fecha_de_prestamo');
                $prestamo->estado = $request->input('estado');
                $prestamo->fecha_de_devolucion = $request->input('fecha_de_devolucion');
                $prestamo->observaciones = $request->input('observaciones');
                $prestamo->status = 3;
    
                if ($tipoBien === 'bienes_muebles') {
                    $prestamo->bienes_muebles_id = $materialId;
                    bienes_muebles::where('id', $materialId)->update(['status' => 2]);
                } elseif ($tipoBien === 'bienes_inmuebles') {
                    $prestamo->bienes_inmuebles_id = $materialId;
                    bienes_inmuebles::where('id', $materialId)->update(['status' => 2]);
                }
    
                $prestamo->save();
            }
    
            return redirect()->route('seguridad.scanear')->with('success', 'Préstamos creados correctamente');
        } catch (\Exception $e) {
            return redirect()->route('seguridad.scanear')->with('error', 'Error al crear los préstamos: ' . $e->getMessage());
        }
    }
    
    
    

private function registrarActividad($accion, $detalles = [])
{
    actividades::create([
        'users_id' => auth()->user()->id,
        'actividad' => $accion,
        'fecha_hora' => now(),
        // Puedes agregar más información si es necesario
    ]);
}
  ///////////////
}
