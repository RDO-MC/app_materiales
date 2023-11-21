<html>
<head>
    <title>Resultados de búsqueda</title>
    <style>
    table {
        max-width: 800px;
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
    }

    th, td {
        border: 1px solid #000;
        padding: 2px;
        text-align: left;
        word-wrap: break-word; /* Permite que las palabras largas se envuelvan en varias líneas */
        max-width: 200px; /* Limita el ancho máximo de las celdas */
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .encabezado {
        width: 100%;
        max-height: 70px;
        display: block;
        margin: 0 auto;
    }

    .centrar {
        text-align: center;
    }

    td {
        font-size: 11px;
    }
    
</style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('uploads/itsz/itsz.jpeg') }}" alt="Imagen de encabezado" class="encabezado">
        <h1 class="centrar">Instituto Tecnológico Superior de Zongolica</h1>
        <h3 class="centrar">Departamento de Recursos Materiales y Servicios</h3>
        <p>Resguardo de Bienes Muebles</p>
        <table>
            <tr>
                <td><strong>NOMBRE</strong></td>
                <td><strong>CARGO</strong></td>
                <td><strong>UNIDAD ACADEMICA</strong></td>
                <td><strong>HOJA</strong></td>
            </tr>
            <tr>
                <td>{{ $asignaciones->first()->user->nombre }} {{ $asignaciones->first()->user->a_paterno }} {{ $asignaciones->first()->user->a_materno }}</td>
                <td>{{ $asignaciones->first()->user->cargo }}</td>
                <td>{{ $asignaciones->first()->user->campus }}</td>
                <td></td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>AÑO</th>
                    <th>No. INVENTARIO</th>
                    <th>No. SERIE</th>
                    <th>DESCRIPCIÓN DEL BIEN</th>
                    <th>U/MEDIDA</th>
                    <th>FACTURA</th>
                    <th>PRECIO</th>
                </tr>
            </thead>
            <tbody>
        @php
            $total = 0; // Inicializamos la variable total
        @endphp
        @foreach ($asignaciones as $asignacion)
    <tr>
        <td>{{ $asignacion->fecha_de_asignacion }}</td>
        <td>
            @if ($asignacion->bienes_muebles_id)
                {{ optional($asignacion->bienesMuebles)->cve_inventario_interno }}
            @elseif ($asignacion->bienes_inmuebles_id)
                {{ optional($asignacion->bienesInmuebles)->cve_inventario_interno }}
            @elseif ($asignacion->activos_nubes_id)
                {{ optional($asignacion->activosNubes)->cve_inventario_interno }}
            @else
                -
            @endif
        </td> 
        <td>
            @if ($asignacion->bienes_muebles_id)
                {{ optional($asignacion->bienesMuebles)->num_serie }}
            @elseif ($asignacion->bienes_inmuebles_id)
                {{ optional($asignacion->bienesInmuebles)->num_serie }}
            @elseif ($asignacion->activos_nubes_id)
                {{ optional($asignacion->activosNubes)->num_serie }}
            @else
                -
            @endif
        </td>
        <td>
            @if ($asignacion->bienes_muebles_id)
                {{ optional($asignacion->bienesMuebles)->descripcion }}
            @elseif ($asignacion->bienes_inmuebles_id)
                {{ optional($asignacion->bienesInmuebles)->descripcion }}
            @elseif ($asignacion->activos_nubes_id)
                {{ optional($asignacion->activosNubes)->descripcion }}
            @else
                -
            @endif
        </td>
        <td>
            @if ($asignacion->bienes_muebles_id)
                {{ optional($asignacion->bienesMuebles)-> partida}}
            @elseif ($asignacion->bienes_inmuebles_id)
                {{ optional($asignacion->bienesInmuebles)->partida }}
            @elseif ($asignacion->activos_nubes_id)
                {{ optional($asignacion->activosNubes)-> partida}}
            @else
                -
            @endif
        </td>
        <td>
            @if ($asignacion->bienes_muebles_id)
                {{ optional($asignacion->bienesMuebles)->factura }}
            @elseif ($asignacion->bienes_inmuebles_id)
                {{ optional($asignacion->bienesInmuebles)->factura }}
            @elseif ($asignacion->activos_nubes_id)
                {{ optional($asignacion->activosNubes)->factura }}
            @else
                -
            @endif
        </td>
        <!-- Agrega más columnas según sea necesario -->
        <td>
            @if ($asignacion->bienes_muebles_id)
                @php
                    $importe = optional($asignacion->bienesMuebles)->importe;
                @endphp
            @elseif ($asignacion->bienes_inmuebles_id)
                @php
                    $importe = optional($asignacion->bienesInmuebles)->importe;
                @endphp
            @elseif ($asignacion->activos_nubes_id)
                @php
                    $importe = optional($asignacion->activosNubes)->importe;
                @endphp
            @else
                @php
                    $importe = 0;
                @endphp
            @endif

            @php
                $total += $importe;
            @endphp

            ${{ number_format($importe, 2) }}
        </td>
    </tr>
@endforeach

    </tbody>
        </table>
        <p>
            <strong>Total:</strong> ${{ number_format($total, 2) }}
        </p>
        <table class="info-table">
    <tr>
        <th><strong>Fecha de Asignación:</strong></th>
        <td>{{ $asignaciones->first()->fecha_de_asignacion }}</td>
    </tr>
    <tr>
        <th><strong>Fecha de Fin de Resguardo:</strong></th>
        <td>{{ $asignaciones->first()->fecha_de_devolucion }}</td>
    </tr>
    <tr>
        <th><strong>Firma del Depositario:</strong></th>
        <td>{{ $asignaciones->first()->user->nombre }} {{ $asignaciones->first()->user->a_paterno }} {{ $asignaciones->first()->user->a_materno }}</td>
    </tr>
</table>
<table class="firmas-table">
    <tr>
        <th><strong>Formuló:</strong></th>
        <th><strong>Revisó:</strong></th>
        <th><strong>Autorizó:</strong></th>
    </tr>
    <tr>
        <td><br>L.C. MARIA FLOR GARCIA TEMOXTLE<br>JEFE DE OFICINA DE ADQUISICIONES</td>
        <td><br>M. C. A. GERARDO TEXCAHUA MORALES<br>JEFE DE DEPTO. DE RECURSOS MATERIALES Y SERVICIOS GENERALES</td>
        <td><br>M. EN A. GLORIA VALDEZ CAMACHO<br>SUBDIRECTORA ADMINISTRATIVA</td>
    </tr>
</table>
<p>
    <strong>EL DEPOSITARIO RESPONDERÁ POR LA PERDIDA, EXTRAVIO, DAÑO O MENOSCABO DE LOS BIENES EN EL LISTADO, COMPROMETIÉNDOSE A DEVOLVERLOS EN CONDICIONES DE USO CUANDO ASÍ SEA REQUERIDO.</strong>
</p>

<p>
    <strong>IMPORTE DE ACTIVO FIJO ES DE: ${{ number_format($total, 2) }}</strong> <!-- Asegúrate de tener la variable $totalImporte con el valor total -->
</p>

    </div>
</body>

</html>
