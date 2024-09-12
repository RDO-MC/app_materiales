<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Activo Nube</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e6f7ff; /* Fondo azul claro */
            color: #495057;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #007bff;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 2px solid #007bff;
            margin: 20px 0;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        /* Personaliza los colores de los estados */
        .status-activo {
            color: #28a745;
        }

        .status-baja {
            color: #dc3545;
        }

        .status-prestado {
            color: #ffc107;
        }

        .status-asignado {
            color: #17a2b8;
        }

        /* Estilos para la tabla de detalles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        /* Estilos para las secciones de estado */
        .status-section {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Detalles del Activo Nube</h1>

    @if ($activos_nube)
        <img src="{{ asset($activos_nube->img_url) }}" alt="Imagen del bien mueble">
        
        <div class="status-section">
            <p><strong>FECHA DE ADQUISICION:</strong> {{ $activos_nube->fecha_adquisicion}}</p>
            <p><strong>FECHA DE VENCIMIENTO:</strong> {{ $activos_nube->fecha_vencimiento}}</p>
            <p><strong>VERSION:</strong> {{ $activos_nube->version}}</p>
            <p><strong>CVE CONAC:</strong> {{ $activos_nube->cve_conac}}</p>
            <p><strong>CVE INVENTARIO INTERNO:</strong> {{ $activos_nube->cve_inventario_interno}}</p>
            <p><strong>CVE INVENTARIO SEFIPLAN:</strong> {{ $activos_nube->cve_inventario_sefiplan}}</p>
            <p><strong>NOMBRE:</strong> {{ $activos_nube->nombre }}</p>
            <p><strong>FECHA:</strong> {{ $activos_nube->fecha }}</p>
            <p><strong>DESCRIPCION:</strong> {{ $activos_nube->descripcion }}</p>
            <p><strong>FACTURA:</strong> {{ $activos_nube->factura}}</p>
            <p><strong>IMPORTE:</strong> {{ $activos_nube->importe}}</p>
            <p><strong>PARTIDA:</strong> {{ $activos_nube->partida}}</p>
            <p><strong>IDENTIFICACION DEL BIEN:</strong> {{ $activos_nube->identificacion_del_bien}}</p>

            <p><strong>STATUS:</strong>
                @switch($activos_nube->status)
                    @case(1)
                        <span class="status-activo">ACTIVO</span>
                        @break

                    @case(0)
                        <span class="status-baja">BAJA</span>
                        @break

                    @case(2)
                        <span class="status-prestado">PRESTADO A:</span>
                        @if($prestamo)
                            <p><strong>USUARIO PRESTADO:</strong> {{ $usuario_asignado ? $usuario_asignado->nombre . ' ' . $usuario_asignado->a_paterno . ' ' . $usuario_asignado->a_materno : 'No asignado' }}</p>
                            <p><strong>LUGAR DE PRESTAMO:</strong> {{ $prestamo->lugar_de_prestamo }}</p>
                            <p><strong>FECHA DE PRESTAMO:</strong> {{ $prestamo->fecha_de_prestamo }}</p>
                        @endif
                        @break

                    @case(3)
                        <span class="status-asignado">ASIGNADO A:</span>
                        @if($asignacion)
                            <p><strong>USUARIO ASIGNADO:</strong>  {{ $usuario_asignado ? $usuario_asignado->nombre . ' ' . $usuario_asignado->a_paterno . ' ' . $usuario_asignado->a_materno : 'Desconocido' }}</p>
                            <p><strong>FECHA DE ASIGNACION:</strong> {{ $asignacion->fecha_de_asignacion }}</p>
                            <p><strong>ORIGEN DE SALIDA:</strong> {{ $asignacion->origen_salida }}</p>
                            <p><strong>LUGAR DE ASIGNACION:</strong> {{ $asignacion->lugar_asignacion }}</p>
                        @endif
                        @break

                    @default
                        Desconocido
                @endswitch
            </p>
        </div>

        <!-- Agrega más secciones o detalles según sea necesario -->

    @else
        <p>Activo Nube no encontrado</p>
    @endif
</body>

</html>
