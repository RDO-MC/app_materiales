@extends('adminlte::page')
@section('title', 'BIENES_INMUEBLES')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('EDITAR BIEN INMUEBLE') }}</div>

                    <div class="card-body">
                        <form  id="editar-inmueble-form"method="POST" action="{{ route('inmuebles.update', $bienes_inmuebles->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Para indicar que es una solicitud de actualización --}}
                            <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('FECHA') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{$bienes_inmuebles->fecha}}" required>
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
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $bienes_inmuebles->nombre }}" required autocomplete="nombre" autofocus>
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
                                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ $bienes_inmuebles->descripcion }}" required autocomplete="descripcion" autofocus>
                                    @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_escritura_propiedad" class="col-md-4 col-form-label text-md-end">{{ __('NUM ESCRITURA PROPIEDAD') }}</label>
                                <div class="col-md-6">
                                    <input id="num_escritura_propiedad" type="text" class="form-control @error('num_escritura_propiedad') is-invalid @enderror" name="num_escritura_propiedad" value="{{ $bienes_inmuebles->num_escritura_propiedad }}" required autocomplete="num_escritura_propiedad" autofocus>
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
                                    <input id="ins_reg_pub_prop" type="text" class="form-control @error('ins_reg_pub_prop') is-invalid @enderror" name="ins_reg_pub_prop" value="{{ $bienes_inmuebles->ins_reg_pub_prop }}" required autocomplete="ins_reg_pub_prop" autofocus>
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
                                    <input id="estado_valuado" type="text" class="form-control @error('estado_valuado') is-invalid @enderror" name="estado_valuado" value="{{ $bienes_inmuebles->estado_valuado }}" required autocomplete="estado_valuado" autofocus>
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
                                    <input id="registro_contable" type="text" class="form-control @error('registro_contable') is-invalid @enderror" name="registro_contable" value="{{ $bienes_inmuebles->registro_contable }}" required autocomplete="registro_contable" autofocus>
                                    @if ($errors->has('registro_contable'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'verifica la informacion' }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_cedula_catastral" class="col-md-4 col-form-label text-md-end">{{ __('NUM CEDULA CATASTRAL') }}</label>
                                <div class="col-md-6">
                                    <input id="num_cedula_catastral" type="text" class="form-control @error('num_cedula_catastral') is-invalid @enderror" name="num_cedula_catastral" value="{{ $bienes_inmuebles->num_cedula_catastral }}" required autocomplete="num_cedula_catastral" autofocus>
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
                                    <input id="val_catastral" type="text" class="form-control @error('val_catastral') is-invalid @enderror" name="val_catastral" value="{{ $bienes_inmuebles->val_catastral }}" required autocomplete="val_catastral" autofocus>
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
                                    <input id="val_comercial" type="text" class="form-control @error('val_comercial') is-invalid @enderror" name="val_comercial" value="{{ $bienes_inmuebles->val_comercial }}" required autocomplete="val_comercial" autofocus>
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
                                    <select id="estado" class="form-control" name="estado" required>
                                        <option value="Bien_Matenido" {{ old('estado', $bienes_inmuebles->estado) === 'Bien_Matenido' ? 'selected' : '' }}>Bien mantenido</option>
                                        <option value="Necesita_Reparcion" {{ old('estado', $bienes_inmuebles->estado) === 'Necesita_Reparcion' ? 'selected' : '' }}>Necesita Reparación</option>
                                        <option value="Desgastado" {{ old('estado', $bienes_inmuebles->estado) === 'Desgastado' ? 'selected' : '' }}>Desgastado</option>
                                        <option value="Otro" {{ old('estado', $bienes_inmuebles->estado) === 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="img_url" class="col-md-4 col-form-label text-md-end">{{ __('IMG') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ asset($bienes_inmuebles->img_url) }}" alt="Imagen del bien mueble" style="max-width: 100%; max-height: 150px;">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="qr" class="col-md-4 col-form-label text-md-end">{{ __('QR') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ $bienes_inmuebles->qr }}" alt="QR del bien inmueble">
                                </div>
                            </div>

                            <!-- Repite lo anterior para otros campos -->

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="btn-editar-inmueble">
                                        {{ __('ACTUALIZAR') }}
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
    const btnEditarInmueble = document.getElementById('btn-editar-inmueble');
    
    btnEditarInmueble.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro  de actuatualizar este bien inmueble?')) {
            // Si el usuario confirma, presenta el formulario
            const EditarInmuebleForm = document.getElementById('editar-inmueble-form');
            EditarInmuebleForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('inmuebles.principal') }}';
        }
    });
});

</script>
@stop