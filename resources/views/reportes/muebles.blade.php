@extends('adminlte::page')

@section('title', 'Bienes Muebles')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Inventario de Bienes Muebles</h3>
                </div>
                <div class="card-body">
                <p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
                <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Fecha</th>  
                                    <th>Cve Conac</th>
                                    <th>Cve Inventario Sefiplan</th>
                                    <th>Cve Inventario Interno</th>
                                    <th>Nombre</th>
                                    <th>Factura</th>
                                    <th>Número de Serie</th>
                                    <th>Importe</th>
                                    <th>Partida</th>
                                    <th>Identificación del Bien</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
                                    <th>Status</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Actualización</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                    $totalImporte = 0;
                                    $totalImporteActivos = 0;
                                    $totalImporteInactivos = 0;
                                    $totalImportePrestamos = 0;
                                @endphp
                                @foreach ($datos as $bienMueble)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $bienMueble->id }}</td>
                                        <td>{{ $bienMueble->fecha }}</td>
                                        <td>{{ $bienMueble->cve_conac }}</td>
                                        <td>{{ $bienMueble->cve_inventario_sefiplan }}</td>
                                        <td>{{ $bienMueble->cve_inventario_interno }}</td>
                                        <td>{{ $bienMueble->nombre }}</td>
                                        <td>{{ $bienMueble->factura }}</td>
                                        <td>{{ $bienMueble->num_serie }}</td>
                                        <td>${{ $bienMueble->importe }}</td>
                                        <td>{{ $bienMueble->partida }}</td>
                                        <td>{{ $bienMueble->identificacion_del_bien }}</td>
                                        <td>{{ $bienMueble->marca }}</td>
                                        <td>{{ $bienMueble->modelo }}</td>
                                        <td>{{ $bienMueble->nota }}</td>
                                        <td>{{ $bienMueble->estado }}</td>
                                        <td>
                                            @if ($bienMueble->status == 0)
                                                <span class="badge badge-danger">Inactivo</span>
                                                @php
                                                    $totalImporteInactivos += $bienMueble->importe;
                                                @endphp
                                            @elseif ($bienMueble->status == 1)
                                                <span class="badge badge-success">Activo</span>
                                                @php
                                                    $totalImporteActivos += $bienMueble->importe;
                                                @endphp
                                            @elseif ($bienMueble->status == 2)
                                                <span class="badge badge-warning">Prestado</span>
                                                @php
                                                    $totalImportePrestamos += $bienMueble->importe;
                                                @endphp
                                            @else
                                                <span class="badge badge-primary">Asignado</span>
                                            @endif
                                        </td>
                                        <td>{{ $bienMueble->created_at }}</td>
                                        <td>{{ $bienMueble->updated_at }}</td>
                                    </tr>
                                    @php
                                        $totalImporte += $bienMueble->importe;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <p class="mt-3">IMPORTE GENERAL:$ {{ $totalImporte }}</p>
                        <p>ACTIVOS:$ {{ $totalImporteActivos }}</p>
                        <p>INACTIVOS:$ {{ $totalImporteInactivos }}</p>
                        <p>ASIGNACIÓN:$ {{ $totalImportePrestamos }}</p>
                    </div>

                    <!-- Agrega el botón para generar el informe en formato PDF -->
                    <form action="{{ route('generar-pdf') }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="tipo_reporte" value="bienes_muebles">
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
