@extends('adminlte::page')
@section('title', 'ACTIVOS NUBE')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ACTIVO NUBE ') }}</div>

                    <div class="card-body">
                        <form  id="crear-activo-form"method="POST" action="{{ route('activos.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3"> 
                                <label for="fecha_adquisicion" class="col-md-4 col-form-label text-md-end">{{ __('FECHA DE ADQUISICION') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha_adquisicion" type="date" class="form-control @error('fecha_adquisicion') is-invalid @enderror" name="fecha_adquisicion" value="{{ old('fecha_adquisicion') }}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="fecha_vencimiento" class="col-md-4 col-form-label text-md-end">{{ __('FECHA DE VENCIMIENTO') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" required>
                                    @error('fecha_vencimiento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="version" class="col-md-4 col-form-label text-md-end">{{ __('VERSION') }}</label>
                                <div class="col-md-6">
                                    <input id="version" type="text" class="form-control @error('version') is-invalid @enderror" name="version" value="{{ old('version') }}" required>
                                    @if ($errors->has('version'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>  
                            <div class="row mb-3">
                                <label for="cve_conac" class="col-md-4 col-form-label text-md-end">{{ __('CVE CONAC') }}</label>
                                <div class="col-md-6">
                                    <input id="cve_conac" type="text" class="form-control @error('cve_conac') is-invalid @enderror" name="cve_conac" value="{{ old('cve_conac') }}" required>
                                    @if ($errors->has('cve_conac'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>                      
                            <div class="row mb-3">
                                <label for="cve_inventario_interno" class="col-md-4 col-form-label text-md-end">{{ __('CVE INVENTARIO INTERNO') }}</label>
                                <div class="col-md-6">
                                    <input id=" cve_inventario_interno" type="text" class="form-control @error('cve_inventario_interno') is-invalid @enderror" name="cve_inventario_interno" value="{{ old('cve_inventario_interno') }}" required>
                                    @if ($errors->has('cve_inventario_interno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'El activo nube ya existe' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="cve_inventario_sefiplan" class="col-md-4 col-form-label text-md-end">{{ __('CVE INVENTARIO SEFIPLAN') }}</label>
                                <div class="col-md-6">
                                    <input id="cve_inventario_sefiplan" type="text" class="form-control @error('cve_inventario_sefiplan') is-invalid @enderror" name="cve_inventario_sefiplan" value="{{ old('cve_inventario_sefiplan') }}" required>
                                    @if ($errors->has('cve_inventario_sefiplan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('NOMBRE') }}</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">{{ __('DESCRIPCION') }}</label>
                                <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autofocus>
                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="factura" class="col-md-4 col-form-label text-md-end">{{ __('FACTURA') }}</label>
                                <div class="col-md-6">
                                    <input id="factura" type="text" class="form-control @error('factura') is-invalid @enderror" name="factura" value="{{ old('factura') }}" required autofocus>
                                    @if ($errors->has('factura'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">   
                                <label for="num_serie" class="col-md-4 col-form-label text-md-end">{{ __('NUMERO DE SERIE') }}</label>
                                <div class="col-md-6">
                                    <input id="num_serie" type="text" class="form-control @error('num_serie') is-invalid @enderror" name="num_serie" value="{{ old('num_serie') }}" required autofocus>
                                    @if ($errors->has('num_serie'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">   
                                <label for="importe" class="col-md-4 col-form-label text-md-end">{{ __('IMPORTE') }}</label>
                                <div class="col-md-6">
                                    <input id="importe" type="text" class="form-control @error('importe') is-invalid @enderror" name="importe" value="{{ old('importe') }}" required autofocus>
                                    @if ($errors->has('importe'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">   
                                <label for="partida" class="col-md-4 col-form-label text-md-end">{{ __('PARTIDA') }}</label>
                                <div class="col-md-6">
                                    <input id="partida" type="text" class="form-control @error('partida') is-invalid @enderror" name="partida" value="{{ old('partida') }}" required autofocus>
                                    @if ($errors->has('partida'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">   
                                <label for="identificacion_del_bien" class="col-md-4 col-form-label text-md-end">{{ __('IDENTIFICACION DEL BIEN') }}</label>
                                <div class="col-md-6">
                                    <input id="identificacion_del_bien" type="text" class="form-control @error('identificacion_del_bien') is-invalid @enderror" name="identificacion_del_bien" value="{{ old('identificacion_del_bien') }}" required autofocus>
                                    @if ($errors->has('identificacion_del_bien'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        

                            <div class="row mb-3">
                                <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('ESTADO') }}</label>
                                <div class="col-md-6">
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}" required autofocus">
                                        
                                        <option value="Bueno">Bueno</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Malo">Malo</option>
                                      
                                    </select>
                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="img_url" class="col-md-4 col-form-label text-md-end">{{ __('IMG') }}</label>
                                <div class="col-md-6">

                                    <input id="img_url" type="file" class="form-control @error('img_url') is-invalid @enderror" name="img_url" required autofocus>
                                    @error('img_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            
                            <!-- Repite el bloque anterior para cada campo necesario -->

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="btn-crear-activo">
                                        {{ __('Crear Activo Nube') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('generar-qr').addEventListener('click', function() {
        const qrCodeValue = 'https://tu-sitio-web.com/detalles/' + Date.now();
        const qr = new QRious({
            value: qrCodeValue,
            size: 150,
        });
        
        // Actualiza la fuente de la imagen con el código QR generado
        document.getElementById('qr-image').src = qr.toDataURL();
    });
});

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnCrearActivo = document.getElementById('btn-crear-activo');
    
    btnCrearActivo.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro  de crear este activo nube?')) {
            // Si el usuario confirma, presenta el formulario
            const crearActivoForm = document.getElementById('crear-activo-form');
            crearActivoForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('activos.principal') }}';
        }
    });
});

</script>
@stop

 