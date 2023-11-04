<?php
namespace App\Http\Controllers;

use App\Models\bienes_muebles;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;






class BienesMueblesController extends Controller
{
    public function index()
    {
        $bienes_muebles = bienes_muebles::all();
        return view('muebles.principal', compact('bienes_muebles'));
    }

    public function create()
    {
        $bienes_muebles = bienes_muebles::all();
        return view('muebles.crear', compact('bienes_muebles'));
    }
    protected function generateQrCode($id)
    {
    // Genera la URL del código QR utilizando el ID del bien inmueble
    $url = route('bienes_muebles.show', $id);

    // Construir la URL del código QR
    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($url) . '&size=200x200';

    return $qrUrl;
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
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

        // Genera el QR Code con la URL completa del bien inmueble
        $qr = $this->generateQrCode(route('bienes_muebles.show', $bienMuebleId));

        // Actualiza el campo 'qr' en el bien inmueble
        $bienes_muebles->qr = $qr;
        $bienes_muebles->save();

        return redirect()->route('muebles.principal')->with('success', 'Bien inmueble creado correctamente');
    } else {
        return redirect()->route('muebles.principal')->with('error', 'La imagen no se pudo cargar');
    }    
    }

    
    public function show(bienes_muebles $bienes_muebles)
    {
        return view('muebles.crear', compact('bienes_muebles'));
    }

    public function edit(bienes_muebles $bienes_muebles)
    {
        return view('muebles.editar', compact('bienes_muebles'));
    }

    public function update(Request $request, bienes_muebles $bienes_muebles)
    {
        $data = $request->validate([


            'fecha' => 'required',
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
            'marca' => 'required',
            'modelo' => 'required',
            'estado' => 'required',
        ]);
    
        // Elimina la imagen anterior si se proporciona una nueva imagen

    
        $bienes_muebles->update($data);
    
        return redirect()->route('muebles.principal');
    }
    

    public function disablemuebles($id)
    {
        $bienes_muebles = bienes_muebles::find($id);
        $bienes_muebles->status = ($bienes_muebles->status == 1) ? 0 : 1;
        $bienes_muebles->save();

        return redirect()->route('muebles.principal')->with('success', 'Estado del bien mueble actualizado correctamente');
    }
}