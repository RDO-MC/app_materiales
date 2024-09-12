<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\bienes_muebles;
use App\Models\bienes_inmuebles;
use App\Models\activos_nube;
use PDF;
use App\Models\actividades;
class ReportesController extends Controller
{
    public function index()
    {
        return view('reportes.crear'); // Mostrar el formulario de generación de reportes
    }

    public function generar(Request $request)
    {
        $tipoReporte = $request->input('tipo_reporte');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
    
        $vista = '';
        $datos = [];
    
        switch ($tipoReporte) {
            case 'bienes_muebles':
                $vista = 'reportes.muebles';
                $datos = bienes_muebles::whereBetween('fecha', [$fechaInicio, $fechaFin])
                    ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                    ->get();
                break;
            case 'bienes_inmuebles':
                $vista = 'reportes.inmuebles';
                $datos = bienes_inmuebles::whereBetween('fecha', [$fechaInicio, $fechaFin])
                    ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                    ->get();
                break;
            case 'activos_nubes':
                $vista = 'reportes.nubes';
                $datos = activos_nube::whereBetween('fecha_adquisicion', [$fechaInicio, $fechaFin])
                    ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                    ->get();
                break;
            default:
                // Manejo de error o tipo de informe no válido.
                // Puedes lanzar una excepción o realizar alguna otra acción adecuada aquí.
                break;
        }
        $accion = "Genero reporte de inventario - Tipo: $tipoReporte, Desde: $fechaInicio, Hasta: $fechaFin";
        $this->registrarActividad($accion);
        return view($vista, compact('datos', 'fechaInicio', 'fechaFin'));
        return view($vista, compact('datos', 'fechaInicio', 'fechaFin'));
    }

    public function generarPDF(Request $request)
{
    // Implementa la lógica para generar el PDF según los parámetros recibidos.
    $tipoReporte = $request->input('tipo_reporte');
    $fechaInicio = $request->input('fecha_inicio');
    $fechaFin = $request->input('fecha_fin');

    // Define una variable para la vista que determina qué vista usar para el PDF.
    $vista = '';
    $datos = []; // Inicializa $datos aquí para evitar el error.
    $nombreArchivo = 'informe.pdf'; // Nombre de archivo predeterminado

    switch ($tipoReporte) {
        case 'bienes_muebles':
            $vista = 'reportes.muebles-pdf';
            $datos = bienes_muebles::whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                ->get();
            $nombreArchivo = 'bienes_muebles_informe.pdf';
            break;
        case 'bienes_inmuebles':
            $vista = 'reportes.inmuebles-pdf';
            $datos = bienes_inmuebles::whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                ->get();
            $nombreArchivo = 'bienes_inmuebles_informe.pdf';
            break;
        case 'activos_nubes':
            $vista = 'reportes.nubes-pdf';
            $datos = activos_nube::whereBetween('fecha_adquisicion', [$fechaInicio, $fechaFin])
                ->orderByRaw("FIELD(status, 1, 2, 3, 0)")
                ->get();
            $nombreArchivo = 'activos_nubes_informe.pdf';
            break;
        default:
            // Manejo de error o tipo de informe no válido.
            // Puedes lanzar una excepción o realizar alguna otra acción adecuada aquí.
            break;
    }

    // Genera el PDF y lo devuelve como descarga con el nombre especificado.
    $pdf = PDF::loadView($vista, compact('datos', 'fechaInicio', 'fechaFin'));
    return $pdf->download($nombreArchivo);
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

}