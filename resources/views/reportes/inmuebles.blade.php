@extends('adminlte::page')

@section('title', 'Bienes Inmuebles')

@section('content')
    <div class="container">
        <h1>Inventario Bienes Inmuebles</h1>
        <p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
        <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>
<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Número de Escritura de Propiedad</th>
                    <th>Inscripción en Registro Público de Propiedad</th>
                    <th>Estado Valuado</th>
                    <th>Registro Contable</th>
                    <th>Número de Cédula Catastral</th>
                    <th>Valor Catastral</th>
                    <th>Valor Comercial</th>
                    <th>Estado</th>
                    <th>Status</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($datos as $bienInmueble) 
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $bienInmueble->id }}</td>
                        <td>{{ $bienInmueble->nombre }}</td>
                        <td>{{ $bienInmueble->descripcion }}</td>
                        <td>{{ $bienInmueble->num_escritura_propiedad }}</td>
                        <td>{{ $bienInmueble->ins_reg_pub_prop }}</td>
                        <td>{{ $bienInmueble->estado_valuado }}</td>
                        <td>{{ $bienInmueble->registro_contable }}</td>
                        <td>{{ $bienInmueble->num_cedula_catastral }}</td>
                        <td>{{ $bienInmueble->val_catastral }}</td>
                        <td>{{ $bienInmueble->val_comercial }}</td>
                        <td>{{ $bienInmueble->estado }}</td>
                        <td>
                            @if ($bienInmueble->status == 0)
                                <span class="badge badge-danger">Inactivo</span>    
                            @elseif ($bienInmueble->status == 2)
                                <span class="badge badge-warning">Prestado</span> 
                            @elseif ($bienInmueble->status == 3)
                                <span class="badge badge-warning">Asignado</span> 
                            @else
                                <span class="badge badge-success">Activo</span>
                            @endif
                            
                        </td>
                        <td>{{ $bienInmueble->created_at }}</td>
                        <td>{{ $bienInmueble->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('generar-pdf') }}" method="post">
            @csrf
            <input type="hidden" name="tipo_reporte" value="bienes_inmuebles">
            <input type="hidden" name="fecha_inicio" value="{{ $fechaInicio }}">
            <input type="hidden" name="fecha_fin" value="{{ $fechaFin }}">
            <button type="submit" class="btn btn-primary">Generar PDF</button>
        </form>
    </div>
@endsection

@section('css')
<style>
    th {
        font-size: 12px;
     }

</style>
@stop

