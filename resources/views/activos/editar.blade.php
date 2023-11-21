@extends('adminlte::page')
@section('title', 'ACTIVOS NUBE')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('EDITAR') }}</div>

            <div class="card-body">

                <form id="editar-activo-form"  method="POST" action="{{ route('activos.update', $activos_nube) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                                <label for="fecha_adquisicion" class="col-md-4 col-form-label text-md-end">{{ __('FECHA DE ADQUISICIONn') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha_adquisicion" type="date" class="form-control @error('fecha_adquisicion') is-invalid @enderror" name="fecha_adquisicion" value="{{$activos_nube->fecha_adquisicion}}" required>
                                    @error('fecha_adquisicion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="fecha_vencimiento" class="col-md-4 col-form-label text-md-end">{{ __('FECHA DE VENCIMIENTO') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha_vencimiento" type="date" class="form-control @error('fecha_vencimiento') is-invalid @enderror" name="fecha_vencimiento" value="{{$activos_nube->fecha_vencimiento}}" required>
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
                                    <input id="version" type="text" class="form-control @error('version') is-invalid @enderror" name="version" value="{{$activos_nube->version}}" required>
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
                                    <input id="cve_conac" type="text" class="form-control @error('cve_conac') is-invalid @enderror" name="cve_conac" value="{{$activos_nube->cve_conac}}" required>
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
                                    <input id="cve_inventario_interno" type="text" class="form-control @error('cve_inventario_interno') is-invalid @enderror" name="cve_inventario_interno" value="{{$activos_nube->cve_inventario_interno}}" required>
                                    @if ($errors->has('cve_inventario_interno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="cve_inventario_sefiplan" class="col-md-4 col-form-label text-md-end">{{ __('CVE INVENTARIO SEFIPLAN') }}</label>
                                <div class="col-md-6">
                                    <input id="cve_inventario_sefiplan" type="text" class="form-control @error('cve_inventario_sefiplan') is-invalid @enderror" name="cve_inventario_sefiplan" value="{{$activos_nube->cve_inventario_sefiplan}}" required>
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
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$activos_nube->nombre}}" required autofocus>
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
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{$activos_nube->descripcion}}" required autofocus>
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
                                    <input id="factura" type="text" class="form-control @error('factura') is-invalid @enderror" name="factura" value="{{$activos_nube->factura}}" required autofocus>
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
                                    <input id="num_serie" type="text" class="form-control @error('num_serie') is-invalid @enderror" name="num_serie" value="{{$activos_nube->num_serie}}" required autofocus>
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
                                    <input id="importe" type="text" class="form-control @error('importe') is-invalid @enderror" name="importe" value="{{$activos_nube->importe}}" required autofocus>
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
                                    <input id="partida" type="text" class="form-control @error('partida') is-invalid @enderror" name="partida" value="{{$activos_nube->partida}}" required autofocus>
                                    @if ($errors->has('partida'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">   
                                <label for="identificacion_del_bien" class="col-md-4 col-form-label text-md-end">{{ __('identificacion_del_bien') }}</label>
                                <div class="col-md-6">
                                    <input id="identificacion_del_bien" type="text" class="form-control @error('identificacion_del_bien') is-invalid @enderror" name="identificacion_del_bien" value="{{$activos_nube->identificacion_del_bien}}" required autofocus>
                                    @error('identificacion_del_bien')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="img_url" class="col-md-4 col-form-label text-md-end">{{ __('Imagen del activo nube') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ asset($activos_nube->img_url) }}" alt="Imagen del activo nube" style="max-width: 100%; max-height: 130px;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="qr" class="col-md-4 col-form-label text-md-end">{{ __('QR') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ $activos_nube->qr }}" alt="QR del activo nube">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('estado') }}</label>
                                <div class="col-md-6">
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required autofocus>
                                        <option value="Bueno" {{ $activos_nube->estado === 'Bueno' ? 'selected' : '' }}>Bueno</option>
                                        <option value="Regular" {{ $activos_nube->estado === 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Malo" {{ $activos_nube->estado === 'Malo' ? 'selected' : '' }}>Malo</option>
                                        <option value="Otro" {{ $activos_nube->estado === 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>
                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                       
                            <button type="submit" class="btn btn-primary" id="btn-actualizar-activo" >
                                {{ __('Actualizar Activo Nube ') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnActualizarActivo = document.getElementById('btn-actualizar-activo');
    
    btnActualizarActivo.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro de que deseas actualizar los datos?')) {
            // Si el usuario confirma, presenta el formulario
            const editarActivoForm = document.getElementById('editar-activo-form');
            editarActivoForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('activos.principal') }}';
        }
    });
});

</script>

@stop

