@extends('adminlte::page')

@section('title', 'MATERIALES ITSZ')

@section('content_header')
    <div class="text-center">
        <h2>MATERIALES ASIGNADOS</h2>
    </div>

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
<thead style="background-color: #0E1264; color: white;">
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
            <th>PRESTADO A</th>
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
                            <td>
                @if ($asignacion->status == 1)
                    {{ $asignacion->estado }}
                @elseif ($asignacion->status == 2)
                    Prestado
                @endif
            </td>
            <td>
                @if ($asignacion->status == 2 && $asignacion->prestamos->isNotEmpty())
                    @foreach($asignacion->prestamos as $prestamo)
                        <span style="color: blue;"> num_empleado:{{  $prestamo->user->num_empleado }}</span> - {{ $prestamo->user->nombre }} {{ $prestamo->user->a_paterno }} {{ $prestamo->user->a_materno }}
                        <br>
                    @endforeach
                @else
                    N/A
                @endif
            </td>




                <td>
                    @if ($asignacion->status == 1)
                        @if ($asignacion->bienes_muebles_id)
                            <a href="{{ route('prestamos.asignacion-prestamo', ['id' => $asignacion->id]) }}" class="btn btn-primary btn-block">Prestar</a>
                        @elseif ($asignacion->bienes_inmuebles_id)
                            {{-- Agrega aquí la lógica para bienes inmuebles si es necesario --}}
                            <a href="{{ route('prestamos.asignacion-prestamo', ['id' => $asignacion->id]) }}" class="btn btn-primary btn-block">Prestar </a>
                        @elseif ($asignacion->activos_nubes_id)
                            {{-- No muestra el botón para activos de nubes --}}
                        @endif
                    @elseif ($asignacion->status == 2)
                       <!-- Botón y formulario para devolver -->
                       <button class="btn btn-success btn-block" onclick="confirmAction({{ $asignacion->id }})">
                            Devolver
                        </button>
                        <form id="disable-form-{{ $asignacion->id }}" action="{{ route('administrativo.realizarDevolucion', ['id' => $asignacion->id]) }}" method="POST" style="display: none;">
                            @method("PUT")
                            @csrf
                            <input type="hidden" name="observaciones" id="observaciones_{{ $asignacion->id }}" value="">
                        </form>
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

function confirmAction(id) {
    console.log('Confirm Action executed with id:', id);
    var action = 'devolver';
    if (confirm('¿Estás seguro de ' + action + ' este material?')) {
        var observaciones = prompt('Por favor, ingresa las observaciones:');
        if (observaciones !== null) {
            console.log('Observaciones:', observaciones);
            document.getElementById('observaciones_' + id).value = observaciones;
            document.getElementById('disable-form-' + id).submit();
        }
    }
}
</script>
@stop
