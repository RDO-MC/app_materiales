<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bien Inmueble Detalle</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Fondo gris claro */
            color: #495057;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #007bff;
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

        /* Estilos para los estados */
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
    </style>
</head>
<body>
    <h1>Detalles del Bien Inmueble</h1>

    @if ($bienes_inmuebles)
        <img src="{{ asset($bienes_inmuebles->img_url) }}" alt="Imagen del bien inmueble">
        <p><strong>NOMBRE:</strong> {{ $bienes_inmuebles->nombre }}</p>
        <p><strong>DESCRIPCION:</strong> {{ $bienes_inmuebles->descripcion }}</p>
        <p><strong>NUM ESCRITURA:</strong> {{ $bienes_inmuebles->num_escritura_propiedad }}</p>
        <p><strong>INS REG PUB PROP:</strong> {{ $bienes_inmuebles->ins_reg_pub_prop }}</p>
        <p><strong>ESTADO VALUADO:</strong> {{ $bienes_inmuebles->estado_valuado }}</p>
        <p><strong>REGISTRO CONTABLE:</strong> {{ $bienes_inmuebles->resgistro_contable }}</p>
        <p><strong>NUM CEDULA CATASTRAL:</strong> {{ $bienes_inmuebles->num_cedula_catastral }}</p>
        <p><strong>VALOR CATASTRAL:</strong> {{ $bienes_inmuebles->val_catastral }}</p>
        <p><strong>VALOR COMERCIAL:</strong> {{ $bienes_inmuebles->val_comercial }}</p>
        <p><strong>ESTADO:</strong> {{ $bienes_inmuebles->estado }}</p>
        <p><strong>STATUS:</strong>
            @switch($bienes_inmuebles->status)
                @case(1)
                    <span class="status-activo">ACTIVO</span>
                    @break
                @case(0)
                    <span class="status-baja">BAJA</span>
                    @break
                @case(2)
                    <span class="status-prestado">PRESTADO A:</span>
                    @if($prestamo)
                        <p><strong>USUARIO PRESTADO :</strong>  {{ $usuario_asignado ? $usuario_asignado->nombre . ' ' . $usuario_asignado->a_paterno . ' ' . $usuario_asignado->a_materno : 'No asignado' }}</p>
                        <!-- Muestra otros detalles del préstamo según tus necesidades -->
                        <p><strong>LUGAR DE PRESTAMO:</strong> {{ $prestamo->lugar_de_prestamo }}</p>
                        <p><strong>FECHA DE PRESTAMO:</strong> {{ $prestamo->fecha_de_prestamo }}</p>
                        <!-- Agrega más detalles según tus necesidades -->
                    @endif
                    @break
                @case(3)
                    <span class="status-asignado">ASIGNADO A:</span>
                    @if($asignacion)
                        <p><strong>USUARIO ASIGNADO:</strong>  {{ $usuario_asignado ? $usuario_asignado->nombre . ' ' . $usuario_asignado->a_paterno . ' ' . $usuario_asignado->a_materno : 'Desconocido' }}</p>
                        <p><strong>FECHA DE ASIGNACION:</strong> {{ $asignacion->fecha_de_asignacion }}</p>
                        <p><strong>ORIGEN DE SALIDA:</strong> {{ $asignacion->origen_salida }}</p>
                        <p><strong>LUGAR DE ASIGNACION:</strong> {{ $asignacion->lugar_asignacion }}</p>
                        <!-- Agrega más detalles según tus necesidades -->
                    @endif
                    @break
                @default
                    Desconocido
            @endswitch
        </p>
    @else
        <p>Bien Inmueble no encontrado</p>
    @endif
</body>
</html>
