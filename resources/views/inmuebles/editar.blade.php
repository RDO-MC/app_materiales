@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('EDITAR BIEN INMUEBLE') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('inmuebles.update', $bienes_inmuebles->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Para indicar que es una solicitud de actualización --}}
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $bienes_inmuebles->nombre }}" required autocomplete="nombre" autofocus>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">{{ __('descripcion') }}</label>
                                <div class="col-md-6">
                                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ $bienes_inmuebles->descripcion }}" required autocomplete="descripcion" autofocus>
                                    @error('descripcio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_escritura_propiedad" class="col-md-4 col-form-label text-md-end">{{ __('num_escritura_propiedad') }}</label>
                                <div class="col-md-6">
                                    <input id="num_escritura_propiedad" type="text" class="form-control @error('num_escritura_propiedad') is-invalid @enderror" name="num_escritura_propiedad" value="{{ $bienes_inmuebles->num_escritura_propiedad }}" required autocomplete="num_escritura_propiedad" autofocus>
                                    @error('num_escritura_propiedad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ins_reg_pub_prop" class="col-md-4 col-form-label text-md-end">{{ __('ins_reg_pub_prop') }}</label>
                                <div class="col-md-6">
                                    <input id="ins_reg_pub_prop" type="text" class="form-control @error('ins_reg_pub_prop') is-invalid @enderror" name="ins_reg_pub_prop" value="{{ $bienes_inmuebles->ins_reg_pub_prop }}" required autocomplete="ins_reg_pub_prop" autofocus>
                                    @error('ins_reg_pub_prop')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="estado_valuado" class="col-md-4 col-form-label text-md-end">{{ __('estado_valuado') }}</label>
                                <div class="col-md-6">
                                    <input id="estado_valuado" type="text" class="form-control @error('estado_valuado') is-invalid @enderror" name="estado_valuado" value="{{ $bienes_inmuebles->estado_valuado }}" required autocomplete="estado_valuado" autofocus>
                                    @error('estado_valuado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="registro_contable" class="col-md-4 col-form-label text-md-end">{{ __('registro_contable') }}</label>
                                <div class="col-md-6">
                                    <input id="registro_contable" type="text" class="form-control @error('registro_contable') is-invalid @enderror" name="registro_contable" value="{{ $bienes_inmuebles->registro_contable }}" required autocomplete="registro_contable" autofocus>
                                    @error('registro_contable')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_cedula_catastral" class="col-md-4 col-form-label text-md-end">{{ __('num_cedula_catastral') }}</label>
                                <div class="col-md-6">
                                    <input id="num_cedula_catastral" type="text" class="form-control @error('num_cedula_catastral') is-invalid @enderror" name="num_cedula_catastral" value="{{ $bienes_inmuebles->num_cedula_catastral }}" required autocomplete="num_cedula_catastral" autofocus>
                                    @error('num_cedula_catastral')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="val_catastral" class="col-md-4 col-form-label text-md-end">{{ __('val_catastral') }}</label>
                                <div class="col-md-6">
                                    <input id="val_catastral" type="text" class="form-control @error('val_catastral') is-invalid @enderror" name="val_catastral" value="{{ $bienes_inmuebles->val_catastral }}" required autocomplete="val_catastral" autofocus>
                                    @error('val_catastral')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="val_comercial" class="col-md-4 col-form-label text-md-end">{{ __('val_comercial') }}</label>
                                <div class="col-md-6">
                                    <input id="val_comercial" type="text" class="form-control @error('val_comercial') is-invalid @enderror" name="val_comercial" value="{{ $bienes_inmuebles->val_comercial }}" required autocomplete="val_comercial" autofocus>
                                    @error('val_comercial')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>
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
                                <label for="img_url" class="col-md-4 col-form-label text-md-end">{{ __('Imagen del bien inmueble') }}</label>
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
                                    <button type="submit" class="btn btn-primary">
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

@stop