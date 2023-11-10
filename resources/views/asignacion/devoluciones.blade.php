@extends('adminlte::page')

@section('title', 'DEVOLUCIONES DE ASIGNACION')

@section('content_header')
    <h1>DEVOLUCIONES DE ASIGNACION</h1>
</section>

<form method="POST" action="{{ route('asignacion.search') }}">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="query" class="form-control" placeholder="Buscar por nombre o número de empleado" aria-label="Buscar" aria-describedby="button-addon">
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
                        <th>ACTIVOS NUBE</th>
                        <th>USUARIOS ID</th>
                        <th>LUGAR DE ASIGNACION</th>
                        <th>FECHA DE ASIGNACIONn</th>
                        <th>ESTADO</th>
                        <th>NOTAS</th>
                        <th>FECHA DE DEVOLUCION</th>
                        <th>OBSERVACIONES</th>
                        <th>STATUS</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->id }}</td>
                            <td>{{ $asignacion->bienes_muebles_id }}</td>
                            <td>{{ $asignacion->bienes_inmuebles_id }}</td>
                            <td>{{ $asignacion->activos_nubes_id }}</td>
                            <td>{{ $asignacion->users_id }}</td>
                            <td>{{ $asignacion->lugar_asignacion }}</td>
                            <td>{{ $asignacion->fecha_de_asignacion }}</td>
                            <td>{{ $asignacion->estado }}</td>
                            <td>{{ $asignacion->notas }}</td>
                            <td>{{ $asignacion->fecha_de_devolucion }}</td>
                            <td>{{ $asignacion->observaciones }}</td>
                            <td>{{ $asignacion->status }}</td>
                            <td>
                                @if ($asignacion->status == 1 && $asignacion->status_devolucion == 0)
                                    <form method="POST" action="{{ route('asignacion.devolver', ['asignacionId' => $asignacion->id]) }}">
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
            <a href="{{ route('asignacion.pdf', ['query' => $query]) }}" class="btn btn-primary">Generar PDF</a>
        </div>
@endif

@endsection

@section('css')

@stop

@section('js')

@stop
