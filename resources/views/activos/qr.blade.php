<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activos PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .activo-container {
            width: 20%; /* Ajusta el ancho según la cantidad de columnas deseadas */
            text-align: center; /* Centra el contenido */
            margin-bottom: 20px;
        }

        .qr-code {
            max-width: 100%;
            height: auto; /* Ajusta el tamaño proporcionalmente */
            margin-bottom: 10px;
        }

        .cve-inventario {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Lista de Activos</h1>

    <div class="row">
        @foreach($activos_nube as $activo)
            <div class="activo-container">
                <img class="qr-code" src="{{ $activo->qr }}" alt="Código QR">
                <div class="cve-inventario">
                    <p>CVE Inventario Interno: {{ $activo->cve_inventario_interno }}</p>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
