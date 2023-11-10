<?php

namespace App\Http\Controllers;

use App\Models\activos_nube;
use Illuminate\Http\Request;

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
        return view('activos.principal', compact('activos_nube'));
    }

   
    public function create()
    {
        $activos_nube = activos_nube::all();
        return view('activos.crear', compact('activos_nube'));
    }
    protected function generateQrCode($id)
    {
    // Genera la URL del código QR utilizando el ID del activo nube
    $url = route('activos_nube.show', $id);

    // Construir la URL del código QR
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($url) . '&size=200x200';

    return $qrUrl;
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'fecha_adquisicion' => 'required',
            'fecha_vencimiento' => 'required',
            'version' => 'required',
            'cve_conac' => 'required',
            'cve_inventario_sefiplan' => 'required',
            'cve_inventario_interno' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'factura' => 'required',
            'num_serie' => 'required',
            'importe' => 'required',
            'partida' => 'required',
            'identificacion_del_bien' => 'required',
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

        // Obtiene el ID del bien inmueble después de guardarlo
        $activoNubeId = $activos_nube->id;

        // Genera el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode(route('activos_nube.show', $activoNubeId));

        // Actualiza el campo 'qr' en el bien inmueble
        $activos_nube->qr = $qr;
        $activos_nube->save();

        return redirect()->route('activos.principal')->with('success', 'activo nube  creado correctamente');
    } else {
        return redirect()->route('activos.principal')->with('error', 'La imagen no se pudo cargar');
    }    
    }

    public function show(activos_nube $activos_nube)
    {
        return view('activos.crear', compact('activos_nube'));
    }

    
    public function edit(activos_nube $activos_nube)
    {
        return view('activos.editar', compact('activos_nube'));
    }

    public function update(Request $request, activos_nube $activos_nube)
    {
        $data = $request->validate([


            'fecha_adquisicion' => 'required',
            'fecha_vencimiento' => 'required',
            'version' =>'required',
            'cve_conac' => 'required',
            'cve_inventario_sefiplan' => 'required',
            'cve_inventario_interno' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'factura' => 'required',
            'num_serie' => 'required',
            'importe' => 'required',
            'partida' => 'required',
            'identificacion_del_bien' => 'required',
            
            'estado' => 'required',
        ]);
    
        // Elimina la imagen anterior si se proporciona una nueva imagen

    
        $activos_nube->update($data);
    
        return redirect()->route('activos.principal');
    }

    
    public function disable($id)
    {
        $activos_nube = activos_nube::find($id);
        $activos_nube->status = ($activos_nube->status == 1) ? 0 : 1;
        $activos_nube->save();

        return redirect()->route('activos.principal')->with('success', 'Estado del bien mueble actualizado correctamente');
    }
}
