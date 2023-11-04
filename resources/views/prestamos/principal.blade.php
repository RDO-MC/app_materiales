@extends('adminlte::page')

@section('title', 'PRESTAMOS')

@section('content_header')
    <h1>Bienes Muebles</h1>
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
                            <th>Muebles</th>
                            <th>Inmuebles</th>
                            <th>Usuarios ID</th>
                            <th>Lugar de Préstamo</th>
                            <th>Fecha de Préstamo</th>
                            <th>Estado</th>
                            <th>Notas</th>
                            <th>Fecha de Devolución</th>
                            <th>Observaciones</th>
                            <th>Status</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestamos as $prestamo)
                            <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ $prestamo->bienes_muebles_id }}</td>
                                <td>{{ $prestamo->bienes_inmuebles_id }}</td>
                                <td>{{ $prestamo->users_id }}</td>
                                <td>{{ $prestamo->lugar_de_prestamo }}</td>
                                <td>{{ $prestamo->fecha_de_prestamo }}</td>
                                <td>{{ $prestamo->estado }}</td>
                                <td>{{ $prestamo->notas }}</td>
                                <td>{{ $prestamo->fecha_de_devolucion }}</td>
                                <td>{{ $prestamo->observaciones }}</td>
                                <td>{{ $prestamo->status }}</td>
                                <td>
                                    @if ($prestamo->status != 1)
                                        <form method="POST" action="{{ route('prestamos.devolver', ['prestamoId' => $prestamo->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Devolver</button>
                                        </form>
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
