@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crear Préstamo de Bienes Muebles') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('prestamos.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="usuario" class="col-md-2 col-form-label text-md-end">{{ __('Usuario') }}</label>
                            <div class="col-md-8">
                                <select id="usuario" class="form-control @error('usuario') is-invalid @enderror" name="usuario" required>
                                    <option></option>
                                    @foreach ($users as $user) 
                                        <option value="{{ $user->id }}">id:{{ $user->id }} #empl:{{ $user->num_empleado }}  nombre:{{ $user->nombre }} {{ $user->a_paterno }}</option>
                                    @endforeach
                                </select>
                                @error('usuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="tipo_bien" class="col-md-2 col-form-label text-md-end">{{ __('Tipo de Bien') }}</label>
                            <div class="col-md-8">
                                <select id="tipo_bien" class="form-control @error('tipo_bien') is-invalid @enderror" name="tipo_bien" required>
                                    <option></option>
                                    <option value="bienes_muebles">Bienes Muebles</option>
                                    <option value="bienes_inmuebles">Bienes Inmuebles</option>
                                </select>
                                @error('tipo_bien')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div id="bienes_muebles_section" style="display: none;">
                            <div class="row mb-3">
                                <label for="bienes_muebles" class="col-md-2 col-form-label text-md-end">{{ __('Bienes Muebles') }}</label>
                                <div class="col-md-8">
                                    <select id="bienes_muebles" class="form-control @error('bienes_muebles') is-invalid @enderror" name="bienes_muebles[]" multiple>
                                        @foreach ($bienes_muebles as $material)
                                            <option value="{{ $material->id }}"> id:{{ $material->id }} marca:{{ $material->marca }}     nombre:{{ $material->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('bienes_muebles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección para Bienes Inmuebles -->
                        <div id="bienes_inmuebles_section" style="display: none;">
                            <div class="row mb-3">
                                <label for="bienes_inmuebles" class="col-md-2 col-form-label text-md-end">{{ __('Bienes Inmuebles') }}</label>
                                <div class="col-md-8">
                                    <select id="bienes_inmuebles" class="form-control @error('bienes_inmuebles') is-invalid @enderror" name="bienes_inmuebles[]" multiple>
                                        @foreach ($bienes_inmuebles as $material)
                                            <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('bienes_inmuebles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                               
                        
                        <div class="row mb-3">
                            <label for="lugar_de_prestamo" class="col-md-2 col-form-label text-md-end">{{ __('Lugar de Préstamo') }}</label>
                            <div class="col-md-8">
                                <input id="lugar_de_prestamo" type="text" class="form-control @error('lugar_de_prestamo') is-invalid @enderror" name="lugar_de_prestamo" required>
                                @error('lugar_de_prestamo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="notas" class="col-md-2 col-form-label text-md-end">{{ __('Notas') }}</label>
                            <div class="col-md-8">
                                <input id="notas" type="text" class="form-control @error('notas') is-invalid @enderror" name="notas">
                                @error('notas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="observaciones" class="col-md-2 col-form-label text-md-end">{{ __('Observaciones') }}</label>
                            <div class="col-md-8">
                                <input id="observaciones" type="text" class="form-control @error('observaciones') is-invalid @enderror" name="observaciones">
                                @error('observaciones')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="estado" class="col-md-2 col-form-label text-md-end" >{{ __('Estado') }}</label>
                            <div class="col-md-8">
                                <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                                    <option></option>
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
                            <label for="fecha_de_prestamo" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Préstamo') }}</label>
                            <div class="col-md-8">
                                <input id="fecha_de_prestamo" type="date" class="form-control @error('fecha_de_prestamo') is-invalid @enderror" name="fecha_de_prestamo" required>
                                @error('fecha_de_prestamo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fecha_de_devolucion" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Devolución') }}</label>
                            <div class="col-md-8">
                                <input id="fecha_de_devolucion" type="date" class="form-control @error('fecha_de_devolucion') is-invalid @enderror" name="fecha_de_devolucion" required>
                                @error('fecha_de_devolucion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

  
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear Préstamo') }}
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

<script src="https://cdn.jsdelivr.net/npm/quagga"></script>

<script>
    const tipoBienSelect = document.getElementById('tipo_bien');
    const bienesMueblesSection = document.getElementById('bienes_muebles_section');
    const bienesInmueblesSection = document.getElementById('bienes_inmuebles_section');

    tipoBienSelect.addEventListener('change', function() {
        if (tipoBienSelect.value === 'bienes_muebles') {
            bienesMueblesSection.style.display = 'block';
            bienesInmueblesSection.style.display = 'none';
        } else if (tipoBienSelect.value === 'bienes_inmuebles') {
            bienesMueblesSection.style.display = 'none';
            bienesInmueblesSection.style.display = 'block';
        } else {
            bienesMueblesSection.style.display = 'none';
            bienesInmueblesSection.style.display = 'none';
        }
    });
</script>
@stop
