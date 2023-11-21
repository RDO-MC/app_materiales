@extends('adminlte::page')

@section('title', 'USUARIOS')

@section('content_header')
    <h1>USUARIOS</h1>
@stop

@section('content')
   

    <input type="text" id="search" class="form-control" placeholder="BURCAR POR NUMERO DE EMPLEADO O EMAIL">



    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="registros-table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>USUARIO/ID</th>
                            <th>FECHA_HORA</th>
                            <th>DIRECCION IP</th>
                            <th>ENT/SAL</th>
                        </tr>
                    </thead>
                <tbody>
                        @php $i=1; @endphp
                        @foreach($registros as $row)
                        <tr style="background-color: {{ $row->exito == 0 ? 'red' : '' }}">
                            <td>{{ $row->id }}</td>
                            <td style="color: {{ $row->exito == 0 ? 'white' : '' }}">
                                @if ($row->user)
                                    {{ $row->user->num_empleado }} {{-- Muestra el número de empleado --}}
                                    {{ $row->user->email }} {{-- Muestra el correo --}}
                                @else
                                    Usuario no disponible
                                @endif
                            </td>
                            <td style="color: {{ $row->exito == 0 ? 'white' : '' }}">{{ $row->fecha_hora }}</td>
                            <td style="color: {{ $row->exito == 0 ? 'white' : '' }}">{{ $row->direccion_ip }}</td>
                            <td>
                                @if ($row->exito == 0)
                                    salió
                                @else
                                    entró
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
  
    

@stop

@section('css')

@stop

@section('js')
<script>
$(document).ready(function() {
    $("#search").on("input", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("#registros-table tbody tr").each(function() {
            var row = $(this);

            // Encuentra la celda que deseas buscar (en este caso, la segunda y tercera columna)
            var cellToSearchNumEmpleado = row.find("td:eq(1)"); // 1 representa la segunda columna (num_empleado)
            var cellToSearchEmail = row.find("td:eq(1)"); // Modificado a 2 para representar la tercera columna (email)

            // Obtiene el texto de las celdas y convierte a minúsculas para la comparación
            var textToSearchNumEmpleado = cellToSearchNumEmpleado.text().toLowerCase();
            var textToSearchEmail = cellToSearchEmail.text().toLowerCase();

            // Modifica la condición para buscar en num_empleado y email
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
