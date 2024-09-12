@extends('adminlte::page')

@section('title', 'DEVOLUCIONES DE ASIGNACION')

@section('content_header')
    <div class="text-center">
        <h2>DEVOLUCION DE ASIGNADOS</h2>
    </div>


    <form method="POST" action="{{ route('asignacion.search') }}">
    @csrf
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Busqueda por numero de empleado para generar resguardo " aria-label="Buscar" aria-describedby="button-addon">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="row mt-3">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="muebles-table">
            <thead style="background-color: #0E1264; color: white;">
                    <tr>
                        <th>ID</th>
                        <th>MUEBLES</th>
                        <th>INMUEBLES</th>
                        <th>ACTIVOS NUBE</th>
                        <th>USUARIO NUM.EMPLEADO</th>
                        <th>LUGAR DE ASIGNACION</th>
                        <th>FECHA DE ASIGNACIONn</th>
                        <th>ESTADO</th>
                        <th>LUGAR DE ASIGNACION</th>
                        <th>STATUS</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->id }}</td>
                            <td>{{ optional($asignacion->bienesMuebles)->cve_inventario_interno }}</td>
                            <td>{{ optional($asignacion->bienes_inmuebles)->num_escritura_propiedad }}</td>
                            <td>{{ optional($asignacion->activosNubes)->cve_inventario_interno }}</td>
                            <td>
                                {{ optional($asignacion->user)->num_empleado }} - {{ optional($asignacion->user)->nombre }} -{{ optional($asignacion->user)->a_paterno }}-{{ optional($asignacion->user)->a_materno }}
                            </td>
                            <td>{{ $asignacion->lugar_asignacion }}</td>
                            <td>{{ $asignacion->fecha_de_asignacion }}</td>
                            <td>{{ $asignacion->estado }}</td>
                            <td>{{ $asignacion->lugar_asignacion }}</td>
                            <td>
                                    @if($asignacion->status == 2)
                                       Asignado-Prestado
                                    @elseif($asignacion->status == 1)
                                        Asignado
                                    @else
                                        {{ $asignacion->estado }}
                                    @endif
                                </td>
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
