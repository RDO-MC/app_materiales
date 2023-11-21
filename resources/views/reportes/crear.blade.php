@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Generar Reporte') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reportes.generar') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="tipo_reporte" class="col-md-2 col-form-label text-md-end" >{{ __('Tipo de Reporte') }}</label>
                            <div class="col-md-8">
                                <select id="tipo_reporte" class="form-control" name="tipo_reporte" required>
                                    <option ></option>
                                    <option value="bienes_muebles">Bienes Muebles</option>
                                    <option value="bienes_inmuebles">Bienes Inmuebles</option>
                                    <option value="activos_nubes">Activos en la Nube</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fecha_inicio" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Inicio') }}</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="fecha_inicio" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fecha_fin" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Fin') }}</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="fecha_fin" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Generar Reporte') }}
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
