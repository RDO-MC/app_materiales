<?php
namespace App\Http\Controllers;
use PDF;
use App\Models\prestamos;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;  
use Illuminate\Support\Facades\View;
use App\Models\actividades;////////////////////////////////////////////////////
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
    /////////////////////////////////////////////////////////////////////////////////////////
    // Obtén los materiales seleccionados en un arreglo
    $materialesSeleccionados = $request->input($tipoBien);
    // Obtén el usuario
    $usuario = User::find($request->input('usuario'));

    // Itera sobre los materiales seleccionados y crea un registro por cada uno
    foreach ($materialesSeleccionados as $materialId) {
        // Registra la actividad
        $accion = ' PRESTAMO DE  : ' . strtoupper($tipoBien) . ' ,AL USUARIO : ' .
        $usuario->nombre . ' '.$usuario->a_paterno . ' CON #EMPLEADO  : ' . $usuario->num_empleado . ' CAMPUS : ' . $usuario->campus ;
    // Agrega información específica del bien prestado
    if ($tipoBien === 'bienes_muebles') {
        $cveInventarioInterno = bienes_muebles::find($materialesSeleccionados[0])->cve_inventario_interno;
        $accion .= ' ,MATERIAL PRESTADO Con CVE Inventario Interno: ' . $cveInventarioInterno . ')';
    } elseif ($tipoBien === 'bienes_inmuebles') {
        $numEscrituraPropiedad = bienes_inmuebles::find($materialesSeleccionados[0])->num_escritura_propiedad;
        $accion .= '  ,MATERIAL PRESTADO Con Num. Escritura Propiedad: ' . $numEscrituraPropiedad . ')';
    }

        $this->registrarActividad($accion);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Crea un registro de préstamo por cada material
        $prestamo = new Prestamos();
        $prestamo->users_id = $request->input('usuario');
        $prestamo->lugar_de_prestamo = $request->input('lugar_de_prestamo');
        $prestamo->fecha_de_prestamo = $request->input('fecha_de_prestamo');
        $prestamo->estado = $request->input('estado');
        $prestamo->fecha_de_devolucion = $request->input('fecha_de_devolucion');
        $prestamo->observaciones = $request->input('observaciones');
        $prestamo->status = 3;

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
    $prestamo = Prestamos::find($prestamoId);

    if (!$prestamo) {
        return redirect()->route('prestamos.devoluciones')->with('error', 'Préstamo no encontrado');
    }

    $tipoBien = $prestamo->bienes_muebles_id ? 'bienes_muebles' : 'bienes_inmuebles';
 ///////////////////////////////////////////////////////////////////////////////
    if ($tipoBien === 'bienes_muebles') {
        $material = bienes_muebles::find($prestamo->bienes_muebles_id);
        bienes_muebles::where('id', $prestamo->bienes_muebles_id)->update(['status' => 1]);
        // Obtén el cve_inventario_interno
        $detalleMaterial = ' (CVE Inventario Interno: ' . $material->cve_inventario_interno . ')';
    } elseif ($tipoBien === 'bienes_inmuebles') {
        $material = bienes_inmuebles::find($prestamo->bienes_inmuebles_id);
        bienes_inmuebles::where('id', $prestamo->bienes_inmuebles_id)->update(['status' => 1]);
        // Obtén el num_escritura_propiedad
        $detalleMaterial = ' (Num. Escritura Propiedad: ' . $material->num_escritura_propiedad . ')';
    }
   
    $usuario = User::find($prestamo->users_id);
    // Registra la actividad de devolución
    $accion = ' Devolucion de Prestamo :' . strtoupper($tipoBien). ' '. ' ,DEVUELVE  :' . $usuario->nombre. ' '.$usuario->a_paterno. ' ' . '  ,CON #EMPLEADO  :' . $usuario->num_empleado. ' '. ',DATOS DE MATERIAL DEVUELTO :'. ' '.$detalleMaterial;
    $this->registrarActividad($accion);
///////////////////////////////////////////////////////////////////////////////////
    // Genera el PDF con la información
    $pdf = PDF::loadView('prestamos.comprobante-pdf', [
        'usuario' => $usuario,
        'material' => $material,
        'tipoBien' => $tipoBien,
        'fecha' => now()->format('d/m/Y'),
    ]);

    // Elimina el registro de préstamo
    $prestamo->delete();

    return $pdf->download('DescargaComprobante.pdf');
}



    //esta  duncion recupera todos los fdatos e ñla tabla de  prestamos y los muestra  en l   vista de  preestamos  devoliuciones 
    //
    public function devolucion()
    {
        // Recupera todos los préstamos desde tu modelo Prestamo
        $prestamos = prestamos::all(); // Asegúrate de que sea "prestamos" en lugar de "Prestamo"
        return view('prestamos.devoluciones', compact('prestamos')); // Pasa $prestamos a la vista
    }
   
    
    public function search(Request $request)
    {
    $query = $request->input('query');

    $prestamos = Prestamos::whereHas('user', function ($queryBuilder) use ($query) {
        $queryBuilder->where('id', 'like', '%' . $query . '%')
                    ->orWhere('num_empleado', 'like', '%' . $query . '%');
    })->get();

    return view('prestamos.devoluciones', compact('prestamos', 'query'));
    }


    public function generatePDF(Request $request)
{
    $query = $request->input('query');

    $prestamos = Prestamos::whereHas('user', function ($queryBuilder) use ($query) {
        $queryBuilder->where('id', 'like', '%' . $query . '%')
            ->orWhere('num_empleado', 'like', '%' . $query . '%');
    })->get();

    // Recupera el primer préstamo (asumiendo que haya al menos uno)
    $primerPrestamo = $prestamos->first();

    // Obtén el usuario a partir del users_id en el primer préstamo
    $usuario = User::find($primerPrestamo->users_id);

    $pdf = PDF::loadView('prestamos.resguardo-pdf', compact('prestamos', 'query', 'usuario'));

    return $pdf->download('DescargaResguardo.pdf');
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
  ////////////////////////////////////////////
    
}