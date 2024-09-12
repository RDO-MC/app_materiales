<?php

namespace App\Http\Controllers;

use App\Models\activos_nube;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\actividades;///////////////////////////////////
use PDF;
use Illuminate\Support\Facades\View;


class ActivosNubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos_nube = activos_nube::all();
        $activos_nube = activos_nube::orderByRaw("FIELD(status, 1, 2, 3, 0)")->get();
        return view('activos.principal', compact('activos_nube'));
    }

   
    public function create()
    {
        $activos_nube = activos_nube::all();
        return view('activos.crear', compact('activos_nube'));
    }
    protected function generateQrCode($relativeUrl)
    {
        $url = url($relativeUrl);
        // Construir la URL del código QR
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($url) . '&size=200x200';
    
        return $qrUrl;
    }
    public function store(Request $request)
    {
        $request->validate([
            'fecha_adquisicion' => 'required',
            'fecha_vencimiento' => 'required',
            'version' => 'required|regex:/^[A-Za-z0-9.\s]+$/',
            'cve_conac' => 'required|numeric',
            'cve_inventario_sefiplan' => 'required|regex:/^[A-Z\/]+$/',
            'cve_inventario_interno' => 'required|regex:/^[A-Z0-9]+$/|unique:activos_nubes',
            'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'factura' => 'required|regex:/^[A-Za-z0-9\-]+$/',
            'num_serie' => 'required|regex:/^[A-Z\/]+$/',
            'importe' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'partida' => 'required|numeric',
            'identificacion_del_bien' => ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'estado' => 'required',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144', // 6144 kiactivos_nube
        ]);

        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $imageName);

            $activos_nube = new activos_nube;

            $activos_nube->fecha_adquisicion = $request->input('fecha_adquisicion');
            $activos_nube->fecha_vencimiento = $request->input('fecha_vencimiento');
            $activos_nube->version= $request ->input('version');
            $activos_nube->cve_conac = $request->input('cve_conac');
            $activos_nube->cve_inventario_sefiplan = $request->input('cve_inventario_sefiplan');
            $activos_nube->cve_inventario_interno = $request->input('cve_inventario_interno');
            $activos_nube->nombre = $request->input('nombre');
            $activos_nube->descripcion = $request->input('descripcion');
            $activos_nube->factura = $request->input('factura');
            $activos_nube->num_serie = $request->input('num_serie');
            $activos_nube->importe = $request->input('importe');
            $activos_nube->partida = $request->input('partida');
            $activos_nube->identificacion_del_bien = $request->input('identificacion_del_bien');
            $activos_nube->marca = '';
            $activos_nube->modelo = '';
            $activos_nube->img_url = 'uploads/' . $imageName;
            $activos_nube->nota = '';
          
            $activos_nube->estado =$request->input('estado');
            $activos_nube->status = '1';

            $activos_nube->save();
            $accion = 'CREÓ UN NUEVO ACTIVO NUBE CON cve_inventario_interno :';
            $detalles = ['cve_inventario_interno' => $activos_nube->cve_inventario_interno];
            $this->registrarActividad($accion, $detalles);

        // Obtiene el ID del bien inmueble después de guardarlo
        $activoNubeId = $activos_nube->id;

        // Genera el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode('/activos_nube/'. $activoNubeId);

        // Actualiza el campo 'qr' en el bien inmueble
        $activos_nube->qr = $qr;
        $activos_nube->save();

        return redirect()->route('activos.principal')->with('success', 'activo nube  creado correctamente');
    } else {
        return redirect()->route('activos.principal')->with('error', 'La imagen no se pudo cargar');
    }    
    }

   
        // El bien no está prestado o asignado o no se encontró
        public function show($id)
        { 
            // Obtener información del bien mueble por ID
            $activos_nube = activos_nube::with(['prestamo.user', 'asignacion.user'])->find($id);
            
            if ($activos_nube && ($activos_nube->status == 2 || $activos_nube->status == 3)) {
                // Verifica si el bien está prestado
                if ($activos_nube->status == 2 && $activos_nube->prestamo) {
                    $prestamo = $activos_nube->prestamo;
                    $usuario_asignado = $prestamo->user;
        
                    // Pasar la información a la vista
                    return view('activos.activos_show', compact('activos_nube', 'prestamo', 'usuario_asignado'));
                }
        
                // Verifica si el bien está asignado
                if ($activos_nube->status == 3 && $activos_nube->asignacion) {
                    $asignacion = $activos_nube->asignacion;
                    $usuario_asignado = $asignacion->user;
        
                    // Pasar la información a la vista
                    return view('activos.activos_show', compact('activos_nube', 'asignacion', 'usuario_asignado'));
                }
            }
        
            // El bien no está prestado o asignado o no se encontró
            return view('activos.activos_show', compact('activos_nube'));
        }

    
    public function edit(activos_nube $activos_nube)
    {
        return view('activos.editar', compact('activos_nube'));
    }

    public function update(Request $request, activos_nube $activos_nube )
    {
        $data = $request->validate([


            'fecha_adquisicion' => 'required',
            'fecha_vencimiento' => 'required',
            'version' => 'required|regex:/^[A-Za-z0-9.\s]+$/', 
            'cve_conac' => 'required|numeric',
            'cve_inventario_sefiplan' => 'required|regex:/^[A-Z\/]+$/',
            'cve_inventario_interno' => [
                'required',
                'regex:/^[A-Z0-9]+$/',
                Rule::unique('activos_nubes')->ignore($activos_nube->id),
            ],
            'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'factura' => 'required|regex:/^[A-Za-z0-9\-]+$/',
            'num_serie' => 'required|regex:/^[A-Z\/]+$/',
            'importe' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'partida' => 'required|numeric',
            'identificacion_del_bien' => ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            
            'estado' => 'required',
        ]);
        
    
        $nombre = ucwords(strtolower(trim($request->input('nombre'))));
        $descripcion = ucwords(strtolower(trim($request->input('descripcion'))));
        $identificacion_del_bien = ucwords(strtolower(trim($request->input('identificacion_del_bien'))));
        $activos_nube->update($data);

        $accion = 'EDITO UN ACTIVO NUBE CON cve_inventario_interno:';
        $detalles = ['cve_inventario_interno' => $activos_nube->cve_inventario_interno];
        $this->registrarActividad($accion, $detalles);
    
        return redirect()->route('activos.principal');
    }

    
    public function disable($id)
    {
        $activos_nube = activos_nube::find($id);
        $activos_nube->status = ($activos_nube->status == 1) ? 0 : 1;
        $activos_nube->save();
                // Acción para registrar
                $accion = ($activos_nube->status == 0) ? 'DIO DE BAJA ACTIVO NUBE CON cve_inventario_interno :' : 'HABILITÓ ACTIVO NUBE CON cve_inventario_interno :';
                // Detalles para registrar
                $detalles = ['cve_inventario_interno' => $activos_nube->cve_inventario_interno];
                $this->registrarActividad($accion, $detalles);

        return redirect()->route('activos.principal')->with('success', 'Estado del bien mueble actualizado correctamente');
    }
    private function registrarActividad($accion, $detalles = [])
    {
        actividades::create([
            'users_id' => auth()->user()->id,
            'actividad' => $accion . ' ' . $detalles['cve_inventario_interno'],
            'fecha_hora' => now(),
            // Puedes agregar más información si es necesario
        ]);
    }
    ///IMPRIMIR QR 
    public function imprimirQR()
{
    $activos_nube = activos_nube::all();

    // Utiliza la vista sin cargarla en el navegador
    $html = View::make('activos.qr', compact('activos_nube'))->render();

    $pdf = PDF::loadHTML($html);
    $pdf->setPaper('letter', 'portrait'); // Tamaño del papel: carta en orientación vertical

    return $pdf->download('activos.qr.pdf');
}
}
 