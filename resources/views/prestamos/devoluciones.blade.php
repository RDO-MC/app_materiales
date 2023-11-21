@extends('adminlte::page')

@section('title', 'DEVOLUCIONES')

@section('content_header')
    <h1>DEVOLUCIONES DE PRESTAMOS</h1>
@stop

@section('content')
    
    <form method="POST" action="{{ route('prestamos.search') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="query" class="form-control" placeholder=" o número de empleado" aria-label="Buscar" aria-describedby="button-addon">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon">Buscar</button>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="muebles-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MUEBLES</th>
                            <th>INMUEBLES</th>
                            <th>NUMERO DE EMPLEADO</th>
                            <th>LUGAR DE PRESTAMO</th>
                            <th>FECHA DE PRESTAMO</th>
                            <th>ESTADO</th>
                            <th>NOTAS</th>
                            <th>FECHA DE DEVOLUCION</th>
                            <th>OBSERVACIONES</th>
                            <th>STATUS</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>   
                    <tbody>
                        @foreach($prestamos as $prestamo)
                             <tr>
                                <td>{{ $prestamo->id }}</td>
                                <td>{{ optional($prestamo->bienes_muebles)->cve_inventario_interno }}</td>
                                <td>{{ optional($prestamo->bienes_inmuebles)->num_escritura_propiedad}}</td>
                                
                                <td>{{ $prestamo->user->num_empleado }}</td>

                                <td>{{ $prestamo->lugar_de_prestamo }}</td>
                                <td>{{ $prestamo->fecha_de_prestamo }}</td>
                                <td>{{ $prestamo->estado }}</td>
                                <td>{{ $prestamo->notas }}</td>
                                <td>{{ $prestamo->fecha_de_devolucion }}</td>
                                <td>{{ $prestamo->observaciones }}</td>
                                <td>
                                    @if($prestamo->status == 3)
                                        Prestado
                                    @elseif($prestamo->status == 1)
                                        Asignado-Prestado
                                    @else
                                        {{ $prestamo->estado }}
                                    @endif
                                </td>
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

    @if (isset($query))
        <div class="mt-3">
            <a href="{{ route('prestamos.pdf', ['query' => $query]) }}" class="btn btn-primary">Generar PDF</a>
        </div>
    @endif
@endsection

@section('css')

@stop

@section('js')

@stop