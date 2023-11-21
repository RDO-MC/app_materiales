<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventario</title>
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
            max-width: 50px;
        }

        th {
            background-color: #f2f2f2;
            font-size: 9px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .encabezado {
            width: 100%;
            max-height: 50px;
            display: block;
            margin: 0 auto;
        }

        .centrar {
            text-align: center;
        }
        .centrar1 {
            text-align: center;
            
        }

        td {
            font-size: 7px;
        }

        .container {
            margin: 20px;
        }

        .btn-pdf {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <img src="{{ public_path('uploads/itsz/itsz.jpeg') }}" alt="Imagen de encabezado" class="encabezado">
        <h1 class="centrar1">Instituto Tecnológico Superior de Zongolica</h1>
        <h3 class="centrar1">Departamento de Recursos Materiales y Servicios</h3>
        <h3>Inventario Bienes Muebles</h3>
        <p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
        <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cve Conac</th>
                    <th>Cve Inventario Sefiplan</th>
                    <th>Cve Inventario Interno</th>
                    <th>Nombre</th>
                    <th>Factura</th>
                    <th>Número de Serie</th>
                    <th>Importe</th>
                    <th>Partida</th>
                    <th>Identificación del Bien</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Nota</th>
                    <th>Estado</th>
                    <th>Status</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($datos))
                    @php
                        $i = 1;
                        $totalImporte = 0;
                        $totalImporteActivos = 0;
                        $totalImporteInactivos = 0;
                        $totalImportePrestamos = 0;
                    @endphp
                    @foreach ($datos as $bienMueble)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bienMueble->id }}</td>
                            <td>{{ $bienMueble->fecha }}</td>
                            <td>{{ $bienMueble->cve_conac }}</td>
                            <td>{{ $bienMueble->cve_inventario_sefiplan }}</td>
                            <td>{{ $bienMueble->cve_inventario_interno }}</td>
                            <td>{{ $bienMueble->nombre }}</td>
                            <td>{{ $bienMueble->factura }}</td>
                            <td>{{ $bienMueble->num_serie }}</td>
                            <td>${{ $bienMueble->importe }}</td>
                            <td>{{ $bienMueble->partida }}</td>
                            <td>{{ $bienMueble->identificacion_del_bien }}</td>
                            <td>{{ $bienMueble->marca }}</td>
                            <td>{{ $bienMueble->modelo }}</td>
                            <td>{{ $bienMueble->nota }}</td>
                            <td>{{ $bienMueble->estado }}</td>
                            <td>
                                @if ($bienMueble->status == 0)
                                    Inactivo
                                    @php
                                        $totalImporteInactivos += $bienMueble->importe;
                                    @endphp
                                @elseif ($bienMueble->status == 2)
                                    Prestado
                                    @php
                                        $totalImportePrestamos += $bienMueble->importe;
                                    @endphp
                                @elseif ($bienMueble->status == 3)
                                    Asignado
                                    @php
                                        $totalImportePrestamos += $bienMueble->importe;
                                    @endphp
                                @else
                                    Activo
                                    @php
                                        $totalImporteActivos += $bienMueble->importe;
                                    @endphp
                                @endif
                            </td>
                            <td>{{ $bienMueble->created_at }}</td>
                            <td>{{ $bienMueble->updated_at }}</td>
                        </tr>
                        @php
                            $totalImporte += $bienMueble->importe;
                        @endphp
                    @endforeach
                @else
                    <p>No se encontraron datos para generar el informe.</p>
                @endif
            </tbody>
        </table>
        <p>IMPORTE GENERAL $ {{ $totalImporte }}  
           ACTIVOS ${{ $totalImporteActivos }}  
           INACTIVOS $ {{ $totalImporteInactivos }}   
           ASIGNACIÓN $ {{ $totalImportePrestamos }}</p>  
    </div>
</body>
</html>
