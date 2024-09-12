@extends('adminlte::page')
@section('title', 'BIENES_INMUEBLES') 
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('REGISTRAR NUEVO BIEN INMUEBLE') }}</div>

                    <div class="card-body">
                       
                        <form  id="crear-inmueble-form"method="POST" action="{{ route('inmuebles.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('FECHA') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('NOMBRE') }}</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
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
                                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>
                                    @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_escritura_propiedad" class="col-md-4 col-form-label text-md-end">{{ __('NUMERO DE ESCRITURA') }}</label>
                                <div class="col-md-6">
                                    <input id="num_escritura_propiedad" type="text" class="form-control @error('num_escritura_propiedad') is-invalid @enderror" name="num_escritura_propiedad" value="{{ old('num_escritura_propiedad') }}" required autocomplete="descripcion" autofocus>
                                    @if ($errors->has('num_escritura_propiedad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ins_reg_pub_prop" class="col-md-4 col-form-label text-md-end">{{ __('INS REG PUB PROP') }}</label>
                                <div class="col-md-6">
                                    <input id="ins_reg_pub_prop" type="text" class="form-control @error('ins_reg_pub_prop') is-invalid @enderror" name="ins_reg_pub_prop" value="{{ old('ins_reg_pub_prop') }}" required autocomplete="ins_reg_pub_prop" autofocus>
                                    @if ($errors->has('ins_reg_pub_prop'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="estado_valuado" class="col-md-4 col-form-label text-md-end">{{ __('ESTADO VALUADO') }}</label>
                                <div class="col-md-6">
                                    <input id="estado_valuado" type="text" class="form-control @error('estado_valuado') is-invalid @enderror" name="estado_valuado" value="{{ old('estado_valuado') }}" required autocomplete="estado_valuado" autofocus>
                                    @if ($errors->has('estado_valuado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="registro_contable" class="col-md-4 col-form-label text-md-end">{{ __('REGISTRO CONTABLE') }}</label>
                                <div class="col-md-6">
                                    <input id="registro_contable" type="text" class="form-control @error('registro_contable') is-invalid @enderror" name="registro_contable" value="{{ old('registro_contable') }}" required autocomplete="registro_contable" autofocus>
                                    @if ($errors->has('registro_contable'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_cedula_catastral" class="col-md-4 col-form-label text-md-end">{{ __('NUMERO DE CEDULA CATASTRAL') }}</label>
                                <div class="col-md-6">
                                    <input id="num_cedula_catastral" type="text" class="form-control @error('num_cedula_catastral') is-invalid @enderror" name="num_cedula_catastral" value="{{ old('num_cedula_catastral') }}" required autocomplete="num_cedula_catastral" autofocus>
                                    @if ($errors->has('num_cedula_catastral'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="val_catastral" class="col-md-4 col-form-label text-md-end">{{ __('VALOR CATASTRAL') }}</label>
                                <div class="col-md-6">
                                    <input id="val_catastral" type="text" class="form-control @error('val_catastral') is-invalid @enderror" name="val_catastral" value="{{ old('val_catastral') }}" required autocomplete="val_catastral" autofocus>
                                    @if ($errors->has('val_catastral'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="val_comercial" class="col-md-4 col-form-label text-md-end">{{ __('VALOR COMERCIAL') }}</label>
                                <div class="col-md-6">
                                    <input id="val_comercial" type="text" class="form-control @error('val_comercial') is-invalid @enderror" name="val_comercial" value="{{ old('val_comercial') }}" required autocomplete="val_comercial" autofocus>
                                    @if ($errors->has('val_comercial'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                           <div class="row mb-3">
                                <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('ESTADO') }}</label>
                                <div class="col-md-6">
                                    <select id="estado" class="form-control" name="estado" required onchange="mostrarOtroEstado(this)">
                                        <option value="Bien_Matenido">Bien matenido</option>
                                        <option value="Necesita_Reparcion">Necesita Reparcion</option>
                                        <option value="Desgastado">Desgastado</option>
                                        
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
                                    <input id="img_url" type="file" class="form-control-file @error('img_url') is-invalid @enderror" name="img_url" required>
                                    @error('img_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Agrega los demás campos de la misma manera -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"  id="btn-crear-inmueble">
                                        {{ __('GUARDAR') }}
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnCrearInmueble = document.getElementById('btn-crear-inmueble');
    
    btnCrearInmueble.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro  de crear este bien inmueble?')) {
            // Si el usuario confirma, presenta el formulario
            const crearInmuebleForm = document.getElementById('crear-inmueble-form');
            crearInmuebleForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('inmuebles.principal') }}';
        }
    });
});

</script>
@stop
