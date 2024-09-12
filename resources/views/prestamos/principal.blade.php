@extends('adminlte::page')

@section('title', 'PRESTAMOS')

@section('content_header')
    <h1 style="color: #54049F;">PRESTAMOS - MUEBLES E INMUEBLES</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-6">
            <button class="btn btn-primary">
                <a href="{{ route('prestamos.crear') }}" style="text-decoration: none; color: white;">CREAR PRÉSTAMO</a>
            </button>
        </div>
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Buscar">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="muebles-table">
                    <thead class="thead-primary">
                        <tr>
                            <th>ID</th>
                            <th>MUEBLES</th>
                            <th>INMUEBLES</th>
                            <th>USUARIO</th>
                            <th>LUGAR DE PRÉSTAMO</th>
                            <th>FECHA DE PRÉSTAMO</th>
                            <th>ESTADO</th>
                            <th>NOTAS</th>
                            <th>FECHA DE DEVOLUCIÓN</th>
                            <th>OBSERVACIONES</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ optional($prestamo->bienes_muebles)->cve_inventario_interno }}</td>
                                <td>{{ optional($prestamo->bienes_inmuebles)->num_escritura_propiedad}}</td>
                                <td>{{ optional($prestamo->user)->num_empleado }}</td>
                                <td>{{ $prestamo->lugar_de_prestamo }}</td>
                                <td>{{ $prestamo->fecha_de_prestamo }}</td>
                                <td>{{ $prestamo->estado }}</td>
                                <td>{{ $prestamo->notas }}</td>
                                <td>{{ $prestamo->fecha_de_devolucion }}</td>
                                <td>{{ $prestamo->observaciones }}</td>
                                <td>
                                    @if($prestamo->status == 3)
                                        <span class="badge badge-success">Prestado</span>
                                    @elseif($prestamo->status == 1)
                                        <span class="badge badge-warning">Asignado-Prestado</span>
                                    @else
                                        <span class="badge badge-info">{{ $prestamo->estado }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .thead-primary th {
            background-color: #830FF0;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }

        .badge-success {
            background-color: #2ecc71;
        }

        .badge-warning {
            background-color: #f39c12;
        }

        .badge-info {
            background-color: #3498db;
        }
    </style>
@stop

@section('js')

<script>
$(document).ready(function() {
    $("#search").on("input", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("#muebles-table tbody tr").each(function() {
            var row = $(this);

            // Concatenamos todos los campos en un solo texto para buscar
            var textToSearch = row.text().toLowerCase();

            if (textToSearch.includes(searchTerm)) {
                row.show();
            } else {
                row.hide();
            }
        });
    });
});
</script>

@stop
