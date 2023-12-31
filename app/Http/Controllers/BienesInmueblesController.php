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
    protected function generateQrCode($id)
{
    // Genera la URL del código QR utilizando el ID del bien inmueble
    $url = route('bienes_inmuebles.show', $id);

    // Construir la URL del código QR
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($url) . '&size=200x200';

    return $qrUrl;
}

public function store(Request $request)
{
   
    $request->validate([
        'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'num_escritura_propiedad' => 'required|numeric',
        'ins_reg_pub_prop' => 'alpha|required',
        'estado_valuado' => 'alpha|required',
        'registro_contable' => 'alpha|required',
        'num_cedula_catastral' => 'numeric|required',
        'val_catastral' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'val_comercial' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'estado'=>'required',
        'img_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('img_url')) {
        $image = $request->file('img_url');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/bienes_inmuebles'), $imageName);

        $bienes_inmuebles = new bienes_inmuebles;
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
        $bienes_inmuebles-> estado = $request->input('estado');
        $bienes_inmuebles->nota = '';
        $bienes_inmuebles->status = '1';

        // Guarda el bien inmueble en la base de datos
        $bienes_inmuebles->save();
        $accion = 'CREÓ UN NUEVO BIEN INMUEBLES  CON num_escritura_propiedad :';
        $detalles = ['num_escritura_propiedad' => $bienes_inmuebles->num_escritura_propiedad];
        $this->registrarActividad($accion, $detalles);

        // Obtiene el ID del bien inmueble después de guardarlo
        $bienInmuebleId = $bienes_inmuebles->id;

        // Genera el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode(route('bienes_inmuebles.show', $bienInmuebleId));

        // Actualiza el campo 'qr' en el bien inmueble
        $bienes_inmuebles->qr = $qr;
        $bienes_inmuebles->save();

       

        return redirect()->route('inmuebles.principal')->with('success', 'Bien inmueble creado correctamente');
    } else {
        return redirect()->route('inmuebles.principal')->with('error', 'La imagen no se pudo cargar');
    }
}


   
    public function show(Request $request,$id)
    {
       
        $bienes_inmuebles = bienes_inmuebles::find($id); 
        return view('inmuebles.show', compact('bienes_inmuebles'));
      

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
        'nombre' =>  ['required', 'string', 'max:30', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'descripcion' =>  ['required', 'string', 'max:150', 'regex:/^[A-Za-záéíóúÁÉÍÓÚ\s]+/'],
        'num_escritura_propiedad' => 'required|numeric',
        'ins_reg_pub_prop' => 'alpha|required',
        'estado_valuado' => 'alpha|required',
        'registro_contable' => 'alpha|required',
        'num_cedula_catastral' => 'numeric|required',
        'val_catastral' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'val_comercial' => 'numeric|regex:/^\d+(\.\d{1,2})?$/|required',
        'estado'=>'required',
        
    ]);

    $bienes_inmuebles->update([
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
}    
   
   