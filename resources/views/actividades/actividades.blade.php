@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1>Actividades</h1>
@stop

@section('content')
    <input type="text" id="search" class="form-control" placeholder="BUSCAR POR NUMERO DE EMPLEADO">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="actividades-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>USUARIO/ID</th>
                            <th>ACTIVIDAD</th>
                            <th>FECHA_HORA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($actividades as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>nombre: {{ $row->user->nombre }} <br> 
                                    empleado: {{ $row->user->num_empleado}}  <br>
                                    campus:{{ $row->user->campus}}   <br>
                                </td>
                                <td>{{ $row->actividad }}</td>
                                <td>{{ $row->fecha_hora }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@section('js')
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                var searchTerm = $(this).val().toLowerCase();

                $("#actividades-table tbody tr").each(function() {
                    var row = $(this);

                    // Encuentra la celda que deseas buscar (en este caso, la segunda columna)
                    var cellToSearch = row.find("td:eq(1)"); // 1 representa la segunda columna (0-indexed)

                    // Obtiene el texto de la celda y convierte a minúsculas para la comparación
                    var textToSearch = cellToSearch.text().toLowerCase();

                    // Modifica la condición para buscar solo en el número de empleado
                    var numEmpleado = row.find("td:eq(1)").text().toLowerCase();
                    if (numEmpleado.includes(searchTerm)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });
    </script>
@stop

@stop
