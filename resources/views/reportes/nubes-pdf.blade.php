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
            font-size: 9px;
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
        <h3>Inventario de Activos Nubess</h3>
        <p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
        <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>FECHA DE ADQUISICION</th>
                    <th>FECHA DE VENCIMIENTO</th>
                    <th>VERSION</th>
                    <th>CVE CONAC</th>
                    <th>CVE INVENTARIO SEFIPLAN</th>
                    <th>CVE INVENTARIO INTERNO</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>FACTURA</th>
                    <th>NUM. SERIE</th>
                    <th>IMPORTE</th>
                    <th>PARTIDA</th>
                    <th>IDENTIFICACION DEL BIEN</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach($datos as $activos)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $activos->fecha_adquisicion}}</td>
                        <td>{{ $activos->fecha_vencimiento }}</td>
                        <td>{{ $activos->version }}</td>
                        <td>{{ $activos->cve_conac }}</td>
                        <td>{{ $activos->cve_inventario_sefiplan }}</td>
                        <td>{{ $activos->cve_inventario_interno }}</td>
                        <td>{{ $activos->nombre }}</td>
                        <td>{{ $activos->descripcion }}</td>
                        <td>{{ $activos->factura }}</td>
                        <td>{{ $activos->num_serie }}</td>
                        <td>{{ $activos->importe }}</td>
                        <td>{{ $activos->partida }}</td>
                        <td>{{ $activos->identificacion_del_bien }}</td> 
                        <td>
                            @if ($activos->status == 0)
                                INACTIVO
                            @elseif ($activos->status == 1)
                                ACTIVO
                            @elseif ($activos->status == 2)
                                PRESTADO
                            @else
                                ASIGNADO
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
