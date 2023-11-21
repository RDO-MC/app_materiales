<!DOCTYPE html>
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
        <p>Nombre: {{ $usuario->nombre }} {{ $usuario->a_paterno }} {{ $usuario->a_materno }}  <br>Empleado: {{ $usuario->num_empleado }}</p>
       <p>CARGO:{{ $usuario->cargo}} </p>
        <p>Bienes a disposicion:</p>

        <table>
            <thead>
                <tr>
                    <th>Muebles</th>
                    <th>Inmuebles</th>
                    <th>Lugar de Préstamo</th> 
                    <th>Estado</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($prestamos as $prestamo)
                <tr>
                    <td>
                        @if ($prestamo->bienes_muebles)
                            ID:{{ $prestamo->bienes_muebles->id }} <br> 
                            NOMBRE: {{ $prestamo->bienes_muebles->nombre }} <br>
                            MARCA:{{ $prestamo->bienes_muebles->marca }} <br>
                            MODELO: {{ $prestamo->bienes_muebles->modelo }} <br>
                            cve_inventario_interno: {{ $prestamo->bienes_muebles->cve_inventario_interno }} <br>
                        @endif
                    </td>
                    <td>
                        @if ($prestamo->bienes_inmuebles)
                            ID:{{ $prestamo->bienes_inmuebles->id }} <br> 
                            NOMBRE:{{ $prestamo->bienes_inmuebles->nombre }} <br>
                            NUM_ESCRITURA_PROPIEDAD: <br> {{ $prestamo->
                            bienes_inmuebles->num_escritura_propiedad }} 
                        @endif
                    </td>
                    <td>{{ $prestamo->lugar_de_prestamo }}</td>
                    <td>{{ $prestamo->estado }}</td>
                    <td>{{ $prestamo->fecha_de_prestamo }}</td>
                    <td>{{ $prestamo->fecha_de_devolucion }}</td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
