@extends('adminlte::page')

@section('title', 'PRESTAMOS')

@section('content_header')
    <h1>PRESTAMOS-MUEBLES E INMUEBLES</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-6">
            <button>
                <a href="{{ route('prestamos.crear') }}" style="text-decoration: none; color: black;">CREAR PRÉSTAMO</a>
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
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MUEBLES</th>
                            <th>INMUEBLES</th>
                            <th>USUARIO</th>
                            <th>LUGAR DE PRESTAMO</th>
                            <th>FECHA DE PRESTAMO</th>
                            <th>ESTADO</th>
                            <th>NOTAS</th>
                            <th>FECHA DE DEVOLUCION</th>
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
                                    @if($prestamo->status ==3 )
                                        Prestado
                                    @elseif($prestamo->status == 1)
                                        Asignado-Prestado
                                    @else
                                        {{ $prestamo->estado }}
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

@stop

@section('js')

@stop