@extends('adminlte::page')

@section('title', 'ACTIVOS NUBE')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inventario de Activos en la Nube</h3>
                </div>
                <div class="card-body">
                <p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
                <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>
                    

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Adquisición</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Versión</th>
                                    <th>CVE CONAC</th>
                                    <th>CVE Inventario SEFIPLAN</th>
                                    <th>CVE Inventario Interno</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Factura</th>
                                    <th>Número de Serie</th>
                                    <th>Importe</th>
                                    <th>Partida</th>
                                    <th>Identificación del Bien</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach($datos as $activos)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $activos->fecha_adquisicion }}</td>
                                        <td>{{ $activos->fecha_vencimiento }}</td>
                                        <td>{{ $activos->version }}</td>
                                        <td>{{ $activos->cve_conac }}</td>
                                        <td>{{ $activos->cve_inventario_sefiplan }}</td>
                                        <td>{{ $activos->cve_inventario_interno }}</td>
                                        <td>{{ $activos->nombre }}</td>
                                        <td>{{ $activos->descripcion }}</td>
                                        <td>{{ $activos->factura }}</td>
                                        <td>{{ $activos->num_serie }}</td>
                                        <td>{{ $activos->importe }}</td>
                                        <td>{{ $activos->partida }}</td>
                                        <td>{{ $activos->identificacion_del_bien }}</td>
                                        <td>
                                            @if ($activos->status == 0)
                                                <span class="badge badge-danger">Inactivo</span>
                                            @elseif ($activos->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                            @elseif ($activos->status == 2)
                                                <span class="badge badge-warning">Prestado</span>
                                            @else
                                                <span class="badge badge-primary">Asignado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('generar-pdf') }}" method="post" class="mt-4">
                        @csrf
                        <input type="hidden" name="tipo_reporte" value="activos_nubes">
                        <input type="hidden" name="fecha_inicio" value="{{ $fechaInicio }}">
                        <input type="hidden" name="fecha_fin" value="{{ $fechaFin }}">
                        <button type="submit" class="btn btn-primary">Generar PDF</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<style>
    th {
        font-size: 12px;
     }

</style>
@stop