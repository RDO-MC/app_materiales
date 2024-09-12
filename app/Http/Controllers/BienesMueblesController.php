<?php
namespace App\Http\Controllers;

use App\Models\bienes_muebles;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\actividades;
use PDF;
use App\Models\prestamos;
use Illuminate\Support\Facades\View;

class BienesMueblesController extends Controller
{
    public function index()
    {
        $bienes_muebles = bienes_muebles::all();
        $bienes_muebles = bienes_muebles::orderByRaw("FIELD(status, 1, 2, 3, 0)")->get();
        return view('muebles.principal', compact('bienes_muebles'));
    }
 
    public function create()
    {
        $bienes_muebles = bienes_muebles::all();
        return view('muebles.crear', compact('bienes_muebles'));
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
            'fecha' => 'required',
            'cve_conac' => 'required|numeric',
            'cve_inventario_sefiplan' => 'required|regex:/^[A-Z\/]+$/',
            'cve_inventario_interno' => 'required|regex:/^[A-Z0-9]+$/|unique:bienes_muebles',
            'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'factura' => 'required|regex:/^[A-Za-z0-9\-]+$/',
            'num_serie' => 'required|regex:/^[A-Z\/]+$/',
            'importe' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'partida' => 'required|numeric',
            'identificacion_del_bien' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'estado' => 'required',
            'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:6144', // 6144 kilobytes (6 MB)
            
            
           
        ]);

        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $imageName);

            $bienes_muebles = new bienes_muebles;

            $bienes_muebles->fecha = $request->input('fecha');
            $bienes_muebles->cve_conac = $request->input('cve_conac');
            $bienes_muebles->cve_inventario_sefiplan = $request->input('cve_inventario_sefiplan');
            $bienes_muebles->cve_inventario_interno = $request->input('cve_inventario_interno');
            $bienes_muebles->nombre = $request->input('nombre');
            $bienes_muebles->descripcion = $request->input('descripcion');
            $bienes_muebles->factura = $request->input('factura');
            $bienes_muebles->num_serie = $request->input('num_serie');
            $bienes_muebles->importe = $request->input('importe');
            $bienes_muebles->partida = $request->input('partida');
            $bienes_muebles->identificacion_del_bien = $request->input('identificacion_del_bien');
            $bienes_muebles->marca = $request->input('marca');
            $bienes_muebles->modelo = $request->input('modelo');
            $bienes_muebles->img_url = 'uploads/' . $imageName;
            $bienes_muebles->nota = '';
            $bienes_muebles->estado =$request->input('estado');
            $bienes_muebles->status = '1';

            $bienes_muebles->save();
    
            // Obtiene el ID del bien inmueble después de guardarlo
            $bienMuebleId = $bienes_muebles->id;
    
           $qr = $this->generateQrCode('/bienes_muebles/' . $bienMuebleId);

    
            // Actualiza el campo 'qr' en el bien inmueble
            $bienes_muebles->qr = $qr;
            $bienes_muebles->save();
    
            $accion = 'CREÓ UN NUEVO BIEN MUEBLES  CON cve_inventario_interno :';
            $detalles = ['cve_inventario_interno' => $bienes_muebles->cve_inventario_interno];
            $this->registrarActividad($accion, $detalles);

        return redirect()->route('muebles.principal')->with('success', 'Bien inmueble creado correctamente');
    } else {
        return redirect()->route('muebles.principal')->with('error', 'La imagen no se pudo cargar');
    }    
    }

    public function show($id)
    { 
    
        // Obtener información del bien mueble por ID
        $bienes_muebles = bienes_muebles::with(['prestamo.user', 'asignacion.user'])->find($id);
        
        if ($bienes_muebles && ($bienes_muebles->status == 2 || $bienes_muebles->status == 3)) {
            // Verifica si el bien está prestado
            if ($bienes_muebles->status == 2 && $bienes_muebles->prestamo) {
                $prestamo = $bienes_muebles->prestamo;
                $usuario_asignado = $prestamo->user;
    
                // Pasar la información a la vista
                return view('muebles.bienes_show', compact('bienes_muebles', 'prestamo', 'usuario_asignado'));
            }
    
            // Verifica si el bien está asignado
            if ($bienes_muebles->status == 3 && $bienes_muebles->asignacion) {
                $asignacion = $bienes_muebles->asignacion;
                $usuario_asignado = $asignacion->user;
    
                // Pasar la información a la vista
                return view('muebles.bienes_show', compact('bienes_muebles', 'asignacion', 'usuario_asignado'));
            } 
        }
    
        // El bien no está prestado o asignado o no se encontró
        return view('muebles.bienes_show', compact('bienes_muebles'));
    }
      

    public function edit(bienes_muebles $bienes_muebles)
    {
        return view('muebles.editar', compact('bienes_muebles'));
    }

    public function update(Request $request, bienes_muebles $bienes_muebles)
    {
        $data = $request->validate([
            'fecha' => 'required',
            'cve_conac' => 'required|numeric',
            'cve_inventario_sefiplan' => 'required|regex:/^[A-Z\/]+$/',
            'cve_inventario_interno' => [
                'required',
                'regex:/^[A-Z0-9]+$/',
                Rule::unique('bienes_muebles')->ignore($bienes_muebles->id),
            ],
            'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
            'factura' => 'required|regex:/^[A-Za-z0-9\-]+$/',
            'num_serie' => 'required|regex:/^[A-Z\/]+$/',
            'importe' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'partida' => 'required|numeric',
            'identificacion_del_bien' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'estado' => 'required',
        ]);
    
        // Elimina la imagen anterior si se proporciona una nueva imagen

    
        $bienes_muebles->update($data);
        $accion = 'EDITO UN BIEN MUEBLES CON cve_inventario_interno:';
        $detalles = ['cve_inventario_interno' => $bienes_muebles->cve_inventario_interno];
        $this->registrarActividad($accion, $detalles);
    
        return redirect()->route('muebles.principal');
    }
    
    public function disablemuebles($id)
    {
        $bienes_muebles = bienes_muebles::find($id);
        $bienes_muebles->status = ($bienes_muebles->status == 1) ? 0 : 1;
        $bienes_muebles->save();
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        // Acción para registrar
        $accion = ($bienes_muebles->status == 0) ? 'DIO DE BAJA BIEN MUEBLES CON cve_inventario_interno :' : 'HABILITÓ MUEBLES CON cve_inventario_interno :';
        // Detalles para registrar
        $detalles = ['cve_inventario_interno' => $bienes_muebles->cve_inventario_interno];
        $this->registrarActividad($accion, $detalles);
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        return redirect()->route('muebles.principal')->with('success', 'Estado del bien mueble actualizado correctamente');
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
    public function imprimirQR()
    {
        $bienes_muebles = bienes_muebles::all();
    
        // Utiliza la vista sin cargarla en el navegador
        $html = View::make('muebles.qr', compact('bienes_muebles'))->render();
    
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('letter', 'portrait'); // Tamaño del papel: carta en orientación vertical
    
        return $pdf->download('bienes-muebles.qr.pdf');
    }
}
