@extends('adminlte::page')

@section('title', 'MATERIALES ITSZ')

@section('content_header')
    <h2>MATERIALES ASIGNADOS</h2>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por Nombre, Descripción o CVE Inventario Interno">
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DESCRIPCION</th>
            <th>CVE INVENTARIO INTERNO</th>
            <th>TIPO DE BIEN</th>
            <th>FECHA DE ASIGNACION</th>
            <th>ORIGEN DE SALIDA</th>
            <th>LUGAR DE ASIGNACION</th>
            <th>ESTADO</th>
            <th>NOTAS</th>
            <th>ACCION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{ $asignacion->id }}</td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        {{ $asignacion->bienesInmuebles->nombre }}
                    @elseif ($asignacion->bienes_muebles_id)
                        {{ $asignacion->bienesMuebles->nombre }}
                    @elseif ($asignacion->activos_nubes_id)
                        {{ $asignacion->activosNubes->nombre }}
                    @endif
                </td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        {{ $asignacion->bienesInmuebles->descripcion }}
                    @elseif ($asignacion->bienes_muebles_id)
                        {{ $asignacion->bienesMuebles->descripcion }}
                    @elseif ($asignacion->activos_nubes_id)
                        {{ $asignacion->activosNubes->descripcion }}
                    @endif
                </td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        {{ $asignacion->bienesInmuebles->cve_inventario_interno }}
                    @elseif ($asignacion->bienes_muebles_id)
                        {{ $asignacion->bienesMuebles->cve_inventario_interno }}
                    @elseif ($asignacion->activos_nubes_id)
                        {{ $asignacion->activosNubes->cve_inventario_interno }}
                    @endif
                </td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        Bienes Inmuebles
                    @elseif ($asignacion->bienes_muebles_id)
                        Bienes Muebles
                    @elseif ($asignacion->activos_nubes_id)
                        Activos Nube
                    @endif
                </td>
                <td>{{ $asignacion->fecha_de_asignacion }}</td>
                <td>{{ $asignacion->origen_salida }}</td>
                <td>{{ $asignacion->lugar_asignacion }}</td>
                <td>{{ $asignacion->estado }}</td>
                <td>{{ $asignacion->notas }}</td>
                <td>
                    @if ($asignacion->status == 1)
                        <a href="{{ route('prestamos.asignacion-prestamo', ['id' => $asignacion->id]) }}" class="btn btn-primary">Prestar</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('js')
<script>
$(document).ready(function() {
    $("#search").on("input", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("table tbody tr").each(function() {
            var row = $(this);

            // Concatenamos los campos de nombre, descripción y CVE
            var textToSearch = row.find('td:eq(1)').text().toLowerCase() +
                              row.find('td:eq(2)').text().toLowerCase() +
                              row.find('td:eq(3)').text().toLowerCase();

            if (textToSearch.includes(searchTerm)) {
                row.show();
            } else {
                row.hide();
            }
        });
    });
});
</script>
@stop
