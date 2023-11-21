<!DOCTYPE html>
<html>
<head>
    <title>Instituto Tecnológico Superior de Zongolica</title>
    <style>
        /* Estilo para la imagen de encabezado */
        .encabezado {
            width: 100%;
            max-height: 70px;
            display: block;
            margin: 0 auto;
        }

        /* Estilo para centrar texto horizontalmente y ajustar altura de línea */
        .centrar {
            text-align: center;
            line-height: 1.5;
        }

        /* Estilo para texto en negritas */
        .negritas {
            font-weight: bold;
        }

        /* Estilo para alinear a la derecha */
        .derecha {
            text-align: right;
        }

        /* Estilo para el área de firma y sello */
        .firma-sello {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        /* Estilo para el nombre y apellidos del usuario */
        .nombre-usuario {
            font-weight: bold;
        }

        /* Estilo para la tabla de detalles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <img src="{{ public_path('uploads/itsz/itsz.jpeg') }}" alt="Imagen de encabezado" class="encabezado">
        <h1 class="centrar">Instituto Tecnológico Superior de Zongolica</h1>
        <h3 class="centrar">Departamento de Recursos Materiales y Servicios</h3>
        <br>

        <!-- Información de Devolución -->
        <p class="derecha">Fecha de Devolución: {{ $fecha }}</p>
        <p class="negritas">Comprobante de Devolución</p>
        <p>
            Este documento justifica que el C.
            <span class="nombre-usuario">
                {{ isset($usuario) ? $usuario->nombre . ' ' . $usuario->a_paterno . ' ' . $usuario->a_materno : '' }}
            </span>
            con número de empleado
            {{ isset($usuario) ? $usuario->num_empleado : '' }}
            quien pertenece al campus
            {{ isset($usuario) ? $usuario->campus : '' }}
            realizó la devolución de tipo
            {{ isset($tipoBien) ? $tipoBien : '' }}.
        </p>
<!-- Detalles de Asignación -->
<table>
    <thead>
        <tr>
            <th>Fecha de Asignación</th>
            <th>Clave Interna</th>
            <th>Número de Serie</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
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
                    {{ optional($asignacion->bienesMuebles)->partida }}
                @elseif ($asignacion->bienes_inmuebles_id)
                    {{ optional($asignacion->bienesInmuebles)->partida }}
                @elseif ($asignacion->activos_nubes_id)
                    {{ optional($asignacion->activosNubes)->partida }}
                @else
                    -
                @endif
            </td>
        </tr>
    </tbody>
</table>

        <!-- Área de Firma y Sello -->
        <div class="firma-sello">
            <p>RECIBIDO POR:</p>
            <p class="centrar">__________________________________________________________________</p>
            <p class="centrar">
                <span class="nombre-usuario">
                    {{ auth()->user()->nombre . ' ' . auth()->user()->a_paterno . ' ' . auth()->user()->a_materno }}
                </span>
            </p>
            <p class="centrar">(Sello y Firma)</p>
        </div>

        <!-- Nota al pie -->
        <br><br><br><br><br><br><br><br>
        <p class="derecha">NOTA: Este documento debe ser firmado y sellado para poder ser válido</p>
    </div>
</body>
</html>
