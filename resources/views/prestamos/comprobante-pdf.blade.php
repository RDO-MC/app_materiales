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
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('uploads/itsz/itsz.jpeg') }}" alt="Imagen de encabezado" class="encabezado">
        <h1 class="centrar">Instituto Tecnológico Superior de Zongolica</h1>
        <h3 class="centrar">Departamento de Recursos Materiales y Servicios</h3>
        <br>
        <p class="derecha">Fecha de Devolución: {{ $fecha }}</p>
        <p class="negritas">Comprobante de Devolución</p>
        
        <p>Este documento justifica que el C. <span class="nombre-usuario">{{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}</span> 
        con número de empleado {{ $usuario->num_empleado }} quien pertenece al campus {{ $usuario->campus }} 
        realizó la devolución de tipo {{ $tipoBien }}.</p>

        @if ($tipoBien === 'bienes_inmuebles')
        <p class="centrar">Datos del bien inmueble: <br>
            Nombre: {{ $material->nombre }} <br>
            Estado Valuado: {{ $material->estado_valuado }} <br>
        </p>
        @else
        <p>Datos del bien mueble: <br>
            Nombre: {{ $material->nombre }} <br>
            Modelo: {{ $material->modelo }} <br>
            Marca: {{ $material->marca }} <br>
        </p>
        @endif

        <div class="firma-sello">
            <p>RECIBIDO POR:</p>
            <p class="centrar">______________________</p>
            <p class="centrar"><span class="nombre-usuario">{{ auth()->user()->nombre }} {{ auth()->user()->a_paterno }} {{ auth()->user()->a_materno }} CARGA:{{ auth()->user()->cargo }}</span></p>
            <p class="centrar">(Sello y Firma)</p>
        </div>

        <br><br><br><br><br><br><br><br>
        <p class="derecha">NOTA: Este documento debe ser firmado y sellado para poder ser válido</p>
    </div>
</body>
</html>