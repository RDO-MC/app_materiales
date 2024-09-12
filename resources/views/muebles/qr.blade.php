<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR de Bienes Muebles</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
 
        .page {
            width: 100%;
            box-sizing: border-box;
            page-break-after: always;
            clear: both;
            padding: 10px; /* Espaciado alrededor de la página */
        }

        .row {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px; /* Aumenta el espacio entre las filas */
            display: flex;
            flex-wrap: wrap; /* Permitir que los elementos se envuelvan a la siguiente línea */
            justify-content: space-between;
        }

        .bienes_muebles-container {
            width: calc(24% - 1cm); /* Ancho ajustado con espacio adicional de 1 cm */
            text-align: center;
            margin-bottom: 20px; /* Aumenta el espacio entre los códigos QR */
            margin-right: 1cm; /* Margen derecho de 1 cm para el espacio horizontal */
            box-sizing: border-box;
            float: left;
        }

        .qr-code {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px; /* Aumenta el espacio entre la imagen y el texto */
        }

        .cve-inventario {
            font-size: 12px;
        }

        .clear {
            width: 100%; 
            box-sizing: border-box;
            clear: both;
        }
    </style>
</head>
<body>
    <?php $contador = 0; ?>
    <div class="page">
        <div class="row">
            @foreach($bienes_muebles as $index => $bien)
                <div class="bienes_muebles-container">
                    <img class="qr-code" src="{{ $bien->qr }}" alt="Código QR">
                    <div class="cve-inventario">
                        <p>CVE Inventario Interno: {{ $bien->cve_inventario_interno }}</p>
                    </div>
                </div>
                <?php $contador++; ?>
                @if ($contador % 3 == 0)
                    <div class="clear"></div> <!-- Salto de línea después de cada tercer código QR -->
                @endif
                @if ($contador % 12 == 0)
                    </div> <!-- Cerrar la fila -->
                    </div> <!-- Cerrar la página -->
                    <div class="page">
                    <div class="row">
                @endif
            @endforeach
        </div> <!-- Cerrar la fila -->
    </div> <!-- Cerrar la página -->
</body>
</html>
