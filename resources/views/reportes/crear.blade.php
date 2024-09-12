@extends('adminlte::page')

@section('content')
<style>
    .card-header {
        background-color: #069D76 ;
        color: #fff;
        text-align: center;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 0.25rem;
    }

    .btn-primary {
        background-color: #069D76;
        border-color: #007BFF;
    }

    .btn-primary:hover {
        background-color: #069D76;
        border-color: #0056b3;
    }

    .container {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Generar Reporte') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reportes.generar') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="tipo_reporte" class="form-label">{{ __('Tipo de Reporte') }}</label>
                            <select id="tipo_reporte" class="form-control" name="tipo_reporte" required>
                                <option></option>
                                <option value="bienes_muebles">Bienes Muebles</option>
                                <option value="bienes_inmuebles">Bienes Inmuebles</option>
                                <option value="activos_nubes">Activos en la Nube</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">{{ __('Fecha de Inicio') }}</label>
                            <input type="date" class="form-control" name="fecha_inicio" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">{{ __('Fecha de Fin') }}</label>
                            <input type="date" class="form-control" name="fecha_fin" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Generar Reporte') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
