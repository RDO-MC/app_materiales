@extends('adminlte::page')
@section('title', 'BIENES MUEBLES')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('EDITAR BIENES MUEBLES') }}</div>

            <div class="card-body">

                <form  id="editar-mueble-form" method="POST" action="{{ route('muebles.update', $bienes_muebles) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('FECHA') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{$bienes_muebles->fecha}}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cve_conac" class="col-md-4 col-form-label text-md-end">{{ __('CVE CONAC') }}</label>
                                <div class="col-md-6">
                                    <input id="cve_conac" type="text" class="form-control @error('cve_conac') is-invalid @enderror" name="cve_conac" value="{{$bienes_muebles->cve_conac}}" required>
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
                                    <input id="cve_inventario_interno" type="text" class="form-control @error('cve_inventario_interno') is-invalid @enderror" name="cve_inventario_interno" value="{{$bienes_muebles->cve_inventario_interno}}" required>
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
                                    <input id="cve_inventario_sefiplan" type="text" class="form-control @error('cve_inventario_sefiplan') is-invalid @enderror" name="cve_inventario_sefiplan" value="{{$bienes_muebles->cve_inventario_sefiplan}}" required>
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
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$bienes_muebles->nombre}}" required autofocus>
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
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{$bienes_muebles->descripcion}}" required autofocus>
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
                                    <input id="factura" type="text" class="form-control @error('factura') is-invalid @enderror" name="factura" value="{{$bienes_muebles->factura}}" required autofocus>
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
                                    <input id="num_serie" type="text" class="form-control @error('num_serie') is-invalid @enderror" name="num_serie" value="{{$bienes_muebles->num_serie}}" required autofocus>
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
                                    <input id="importe" type="text" class="form-control @error('importe') is-invalid @enderror" name="importe" value="{{$bienes_muebles->importe}}" required autofocus>
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
                                    <input id="partida" type="text" class="form-control @error('partida') is-invalid @enderror" name="partida" value="{{$bienes_muebles->partida}}" required autofocus>
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
                                    <input id="identificacion_del_bien" type="text" class="form-control @error('identificacion_del_bien') is-invalid @enderror" name="identificacion_del_bien" value="{{$bienes_muebles->identificacion_del_bien}}" required autofocus>
                                    @if ($errors->has('identificacion_del_bien'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="marca" class="col-md-4 col-form-label text-md-end">{{ __('MARCA') }}</label>
                                <div class="col-md-6">
                                <input id="marca" type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" value="{{$bienes_muebles->marca}}" required autofocus>
                                @if ($errors->has('marca'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="modelo" class="col-md-4 col-form-label text-md-end">{{ __('MODELO') }}</label>
                                <div class="col-md-6">
                                <input id="modelo" type="text" class="form-control @error('modelo') is-invalid @enderror" name="modelo" value="{{$bienes_muebles->modelo}}" required autofocus>
                                @if ($errors->has('modelo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="img_url" class="col-md-4 col-form-label text-md-end">{{ __('IMG') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ asset($bienes_muebles->img_url) }}" alt="Imagen del bien mueble" style="max-width: 100%; max-height: 130px;">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="qr" class="col-md-4 col-form-label text-md-end">{{ __('QR') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ $bienes_muebles->qr }}" alt="QR del bien mueble">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('ESTADO') }}</label>
                                <div class="col-md-6">
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required autofocus>
                                        <option value="Bueno" {{ $bienes_muebles->estado === 'Bueno' ? 'selected' : '' }}>Bueno</option>
                                        <option value="Regular" {{ $bienes_muebles->estado === 'Regular' ? 'selected' : '' }}>Regular</option>
                                        <option value="Malo" {{ $bienes_muebles->estado === 'Malo' ? 'selected' : '' }}>Malo</option>
                                        <option value="Otro" {{ $bienes_muebles->estado === 'Otro' ? 'selected' : '' }}>Otro</option>
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
                            <button type="submit" class="btn btn-primary" id="btn-editar-mueble">
                                {{ __('Actualizar Bien Mueble') }}
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
    const btnEditarMueble = document.getElementById('btn-editar-mueble');
    
    btnEditarMueble.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro  de actualizar  los datos?')) {
            // Si el usuario confirma, presenta el formulario
            const editarMuebleForm = document.getElementById('editar-mueble-form');
        editarMuebleForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('muebles.principal') }}';
        }
    });
});

</script>


@stop





