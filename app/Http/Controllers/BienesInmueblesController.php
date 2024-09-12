<?php

namespace App\Http\Controllers;
use App\Models\Registro; 
use App\Models\actividades; 
use GuzzleHttp\Client;
use App\Models\bienes_inmuebles;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;
class BienesInmueblesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bienes_inmuebles = bienes_inmuebles::all();
        $bienes_inmuebles = bienes_inmuebles::orderByRaw("FIELD(status, 1, 2, 3, 0)")->get();
        return view('inmuebles.principal', compact('bienes_inmuebles'));
    }

   
    public function create()
    {
        $bienes_inmuebles = bienes_inmuebles::all();
        return view('inmuebles.crear', compact('bienes_inmuebles'));
    }
    protected function generateQrCode($relativeUrl)
    {
        // Genera la URL del código QR utilizando el ID del bien inmueble
        $url = url($relativeUrl);
    
        // Construir la URL del código QR
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($url) . '&size=200x200';
    
        return $qrUrl;
       
    }

public function store(Request $request)
{
    $rules = [
        'fecha' => 'required',
        'nombre' => ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'descripcion' => ['required', 'string', 'max:500'],
        'num_escritura_propiedad' => 'required|numeric',
        'ins_reg_pub_prop' => 'alpha|required',
        'estado_valuado' => 'alpha|required',
        'registro_contable' => 'alpha|required',
        'num_cedula_catastral' => 'required',
        'val_catastral' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'val_comercial' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'estado' => 'required',
    ];

    if ($request->hasFile('img_url')) {
        $rules['img_url'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    $request->validate($rules);

    if ($request->hasFile('img_url')) {
        // Procesar la imagen si se proporciona
        $image = $request->file('img_url');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/bienes_inmuebles'), $imageName);

        // Crear y guardar el bien inmueble con la imagen
        $bienes_inmuebles = new bienes_inmuebles;
        $bienes_inmuebles->fecha = $request->input('fecha');
        $bienes_inmuebles->nombre = $request->input('nombre');
        $bienes_inmuebles->descripcion = $request->input('descripcion');
        $bienes_inmuebles->num_escritura_propiedad = $request->input('num_escritura_propiedad');
        $bienes_inmuebles->ins_reg_pub_prop = $request->input('ins_reg_pub_prop');
        $bienes_inmuebles->estado_valuado = $request->input('estado_valuado');
        $bienes_inmuebles->registro_contable = $request->input('registro_contable');
        $bienes_inmuebles->num_cedula_catastral = $request->input('num_cedula_catastral');
        $bienes_inmuebles->val_catastral = $request->input('val_catastral');
        $bienes_inmuebles->val_comercial = $request->input('val_comercial');
        $bienes_inmuebles->img_url = 'uploads/bienes_inmuebles/' . $imageName;
        $bienes_inmuebles->estado = $request->input('estado');
        $bienes_inmuebles->nota = '';
        $bienes_inmuebles->status = '1';
        $bienes_inmuebles->save();

        // Acción para registrar
        $accion = 'CREÓ UN NUEVO BIEN INMUEBLES CON num_escritura_propiedad :';
        $detalles = ['num_escritura_propiedad' => $bienes_inmuebles->num_escritura_propiedad];
        $this->registrarActividad($accion, $detalles);

        // Generar el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode('/bienes_inmuebles/' . $bienes_inmuebles->id);

        // Actualizar el campo 'qr' en el bien inmueble
        $bienes_inmuebles->qr = $qr;
        $bienes_inmuebles->save();

        return redirect()->route('inmuebles.principal')->with('success', 'Bien inmueble creado correctamente');
    } else {
        // Si no se proporciona una imagen, guardar el bien inmueble sin ella
        $bienes_inmuebles = new bienes_inmuebles;
        $bienes_inmuebles->fecha = $request->input('fecha');
        $bienes_inmuebles->nombre = $request->input('nombre');
        $bienes_inmuebles->descripcion = $request->input('descripcion');
        $bienes_inmuebles->num_escritura_propiedad = $request->input('num_escritura_propiedad');
        $bienes_inmuebles->ins_reg_pub_prop = $request->input('ins_reg_pub_prop');
        $bienes_inmuebles->estado_valuado = $request->input('estado_valuado');
        $bienes_inmuebles->registro_contable = $request->input('registro_contable');
        $bienes_inmuebles->num_cedula_catastral = $request->input('num_cedula_catastral');
        $bienes_inmuebles->val_catastral = $request->input('val_catastral');
        $bienes_inmuebles->val_comercial = $request->input('val_comercial');
        $bienes_inmuebles->estado = $request->input('estado');
        $bienes_inmuebles->nota = '';
        $bienes_inmuebles->status = '1';
        $bienes_inmuebles->save();

        // Acción para registrar
        $accion = 'CREÓ UN NUEVO BIEN INMUEBLES CON num_escritura_propiedad :';
        $detalles = ['num_escritura_propiedad' => $bienes_inmuebles->num_escritura_propiedad];
        $this->registrarActividad($accion, $detalles);

        // Generar el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode('/bienes_inmuebles/' . $bienes_inmuebles->id);

        // Actualizar el campo 'qr' en el bien inmueble
        $bienes_inmuebles->qr = $qr;
        $bienes_inmuebles->save();

        return redirect()->route('inmuebles.principal')->with('success', 'Bien inmueble creado correctamente');
    }
}

public function show($id)
{       
    
        // Obtener información del bien mueble por ID
        $bienes_inmuebles = bienes_inmuebles::with(['prestamo.user', 'asignacion.user'])->find($id);
        
        if ($bienes_inmuebles && ($bienes_inmuebles->status == 2 || $bienes_inmuebles->status == 3)) {
            // Verifica si el bien está prestado
            if ($bienes_inmuebles->status == 2 && $bienes_inmuebles->prestamo) {
                $prestamo = $bienes_inmuebles->prestamo;
                $usuario_asignado = $prestamo->user;
    
                // Pasar la información a la vista
                return view('inmuebles.inmuebles_show', compact('bienes_inmuebles', 'prestamo', 'usuario_asignado'));
            }
    
            // Verifica si el bien está asignado
            if ($bienes_inmuebles->status == 3 && $bienes_inmuebles->asignacion) {
                $asignacion = $bienes_inmuebles->asignacion;
                $usuario_asignado = $asignacion->user;
    
                // Pasar la información a la vista
                return view('inmuebles.inmuebles_show', compact('bienes_inmuebles', 'asignacion', 'usuario_asignado'));
            }
        }
    
        // El bien no está prestado o asignado o no se encontró
        return view('inmuebles.inmuebles_show', compact('bienes_inmuebles'));
   
  

}
    public function edit(Request $request, $id)
    {
        $bienes_inmuebles = Bienes_Inmuebles::find($id);
    
        // Verificar si el bien inmueble ha sido dado de baja
        if ($bienes_inmuebles->status == 0) {
            return redirect()->route('inmuebles.principal')
                ->with('error', 'No puedes editar un bien inmueble dado de baja');
        }
    
        // Si el bien inmueble no está dado de baja, permitir la edición
        return view('inmuebles.editar', compact('bienes_inmuebles'));
    }
    

    public function update(Request $request, $id)
{
    $bienes_inmuebles = Bienes_Inmuebles::find($id);

    
    $request->validate([
        'fecha'=>'required',
        'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'descripcion' => ['required', 'string', 'max:500'],
        'num_escritura_propiedad' => 'required|numeric',
        'ins_reg_pub_prop' => 'alpha|required',
        'estado_valuado' => 'alpha|required',
        'registro_contable' => 'alpha|required',
        'num_cedula_catastral' => 'required',
        'val_catastral' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'val_comercial' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'estado'=>'required',
        
    ]);

    $bienes_inmuebles->update([
        'fecha' => $request->input('fecha'),
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
        'num_escritura_propiedad' => $request->input('num_escritura_propiedad'),
        'ins_reg_pub_prop' => $request->input('ins_reg_pub_prop'),
        'estado_valuado' => $request->input('estado_valuado'),
        'registro_contable' => $request->input('registro_contable'),
        'num_cedula_catastral' => $request->input('num_cedula_catastral'),
        'val_catastral' => $request->input('val_catastral'),
        'val_comercial' => $request->input('val_comercial'),
        'estado' => $request->input('estado'),
        
        
        
    ]);
  
    $accion = 'EDITO UN BIEN INMUEBLES CON num_escritura_propiedad:';
    $detalles = ['num_escritura_propiedad' => $bienes_inmuebles->num_escritura_propiedad];
    $this->registrarActividad($accion, $detalles);

    return redirect()->route('inmuebles.principal')
        ->with('success', 'Inmueble actualizado exitosamente');
}

public function disableUser(Request $request, $id)
{
    $bienes_inmuebles = bienes_inmuebles::find($id);

    // Cambiar el estado del bien inmueble
    $bienes_inmuebles->status = ($bienes_inmuebles->status == 1) ? 0 : 1;

    // Obtener la nota del formulario si está presente
    $nota = $request->input('nota', null);

    // Asignar la nota si está presente    
    if ($nota !== null) {
        $bienes_inmuebles->nota = $nota;
    }

    $bienes_inmuebles->save();

    // Acción para registrar
    $accion = ($bienes_inmuebles->status == 0) ? 'DIO DE BAJA BIEN INMUEBLES CON num_escritura_propiedad:' : 'HABILITÓ INMUEBLES CON num_escritura_propiedad:';

    // Detalles para registrar
    $detalles = ['num_escritura_propiedad' => $bienes_inmuebles->num_escritura_propiedad];

    $this->registrarActividad($accion, $detalles);

    return redirect()->route('inmuebles.principal')
        ->with('success', 'Estado del bien inmueble fue actualizado correctamente');
}

    public function getStatusText($status)
    {
        switch ($status) {
            case 0:
                return 'Inactivo';
            case 1:
                return 'Activo';
            case 2:
                return 'Préstamo';
            case 3:
                return 'Asignado';
            default:
                return 'Desconocido';
        }
    }
    private function registrarActividad($accion, $detalles = [])
    {
        actividades::create([
            'users_id' => auth()->user()->id,
            'actividad' => $accion . ' ' . $detalles['num_escritura_propiedad'],
            'fecha_hora' => now(),
            // Puedes agregar más información si es necesario
        ]);
    }
    public function imprimirQR()
    {
        $bienes_inmuebles =bienes_inmuebles::all();
    
        // Utiliza la vista sin cargarla en el navegador
        $html = View::make('inmuebles.qr', compact('bienes_inmuebles'))->render();
    
        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('letter', 'portrait'); // Tamaño del papel: carta en orientación vertical
    
        return $pdf->download('bienes-inmuebles.qr.pdf');
    }

}    
   
   