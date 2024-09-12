@extends('adminlte::page')

@section('title', 'USUARIOS')

@section('content_header')
    <h1 style="color: #3498db;">Usuarios</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-5">
            <input type="text" id="search" class="form-control" placeholder="Buscar por número de empleado o correo electrónico">
        </div>
    </div>
    

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="registros-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario/ID</th>
                            <th>Fecha y Hora</th>
                            <th>Dirección IP</th>
                            <th>Entrada/Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($registros as $row)
                            <tr style="background-color: {{ $row->exito == 0 ? '#e74c3c' : '' }}; color: {{ $row->exito == 0 ? 'white' : '' }}">
                                <td>{{ $row->id }}</td>
                                <td>
                                    @if ($row->user)
                                        <span style="color: #3498db;">Número de Empleado:</span> {{ $row->user->num_empleado }} <br>
                                        <span style="color: #3498db;">Correo Electrónico:</span> {{ $row->user->email }}
                                    @else
                                        Usuario no disponible
                                    @endif
                                </td>
                                <td>{{ $row->fecha_hora }}</td>
                                <td>{{ $row->direccion_ip }}</td>
                                <td>
                                    @if ($row->exito == 0)
                                        Salió
                                    @else
                                        Entró
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>

        
        body {
            background-color: #ecf0f1;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        th {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .form-control {
            border: 2px solid #3498db;
            color: #3498db;
        }

        #registros-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #registros-table th, #registros-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #registros-table tbody tr:hover {
            background-color: #dfe6e9;
        }
    </style>
    <style>
        .custom-thead {
            background-color: #3498db; /* Cambia este color según tus preferencias */
            color: #ffffff; /* Cambia este color según tus preferencias */
        }
    </style>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                var searchTerm = $(this).val().toLowerCase();

                $("#registros-table tbody tr").each(function() {
                    var row = $(this);

                    var cellToSearchNumEmpleado = row.find("td:eq(1)");
                    var cellToSearchEmail = row.find("td:eq(1)");

                    var textToSearchNumEmpleado = cellToSearchNumEmpleado.text().toLowerCase();
                    var textToSearchEmail = cellToSearchEmail.text().toLowerCase();

                    if (textToSearchNumEmpleado.includes(searchTerm) || textToSearchEmail.includes(searchTerm)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });
    </script>
@stop
