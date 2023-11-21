<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventario Inmuebles</title>
    <style>
        table {
            max-width: 800px;
            width: 105%;
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
            font-size: 9px;
        }

        .centrar1 {
            text-align: center;
            
        }

        td {
            font-size: 8px;
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
        <h3>Inventario Bienes Inmuebles</h3>
        <<p>Fecha de inicio: {{ date('d-m-Y', strtotime($fechaInicio)) }}</p>
        <p>Fecha de fin: {{ date('d-m-Y', strtotime($fechaFin)) }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>      
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Número de Escritura de Propiedad</th>
                    <th>Inscripción en Registro Público de Propiedad</th>
                    <th>Estado Valuado</th>
                    <th>Registro Contable</th>
                    <th>Número de Cédula Catastral</th>
                    <th>Valor Catastral</th>
                    <th>Valor Comercial</th>
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
                        $totalValorComercial = 0;
                    @endphp
                    @foreach ($datos as $bienInmueble)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bienInmueble->id }}</td>
                            <td>{{ $bienInmueble->nombre }}</td>
                            <td>{{ $bienInmueble->descripcion }}</td>
                            <td>{{ $bienInmueble->num_escritura_propiedad }}</td>
                            <td>{{ $bienInmueble->ins_reg_pub_prop }}</td>
                            <td>{{ $bienInmueble->estado_valuado }}</td>
                            <td>{{ $bienInmueble->registro_contable }}</td>
                            <td>{{ $bienInmueble->num_cedula_catastral }}</td>
                            <td>{{ $bienInmueble->val_catastral }}</td>
                            <td>{{ $bienInmueble->val_comercial }}</td>
                            <td>{{ $bienInmueble->estado }}</td>
                            <td>
                                @if ($bienInmueble->status == 0)
                                    Inactivo
                                @elseif ($bienInmueble->status == 2)
                                    Prestado
                                @elseif ($bienInmueble->status == 3)
                                    Asignado
                                @else
                                    Activo
                                @endif
                            </td>
                            <td>{{ $bienInmueble->created_at }}</td>
                            <td>{{ $bienInmueble->updated_at }}</td>
                        </tr>
                        @php
                            $totalValorComercial += $bienInmueble->val_comercial;
                        @endphp
                    @endforeach
                </tbody>
                </table>
                <p>Valor Comercial: {{ $totalValorComercial }}</p>
            @else
                <p>No se encontraron datos para generar el informe.</p>
            @endif
        </div>
    </body>
</html>
