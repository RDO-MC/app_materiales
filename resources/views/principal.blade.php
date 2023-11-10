@extends('adminlte::page')

@section('title', 'MATERIALES ITSZ')

@section('content_header')
    <h1>MATERIALES ASIGNADOS</h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Fecha de Asignación</th>
                <th>Origen de salida</th>
                <th>Lugar de asignación</th>
                <th>Estado</th>
                <th>Notas</th>
                <!-- Agrega más encabezados de columna según tus necesidades -->
            </tr>
        </thead>
        <tbody>
        @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{ $asignacion->id }}</td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        {{ $asignacion->bienesInmuebles->nombre }}
                    @elseif ($asignacion->bienes_muebles_id)
                        {{ $asignacion->bienesMuebles->nombre }}
                    @elseif ($asignacion->activos_nubes_id)
                        {{ $asignacion->activosNubes->nombre }}
                    @endif
                </td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        {{ $asignacion->bienesInmuebles->descripcion }}
                    @elseif ($asignacion->bienes_muebles_id)
                        {{ $asignacion->bienesMuebles->descripcion }}
                    @elseif ($asignacion->activos_nubes_id)
                        {{ $asignacion->activosNubes->descripcion }}
                    @endif
                </td>
                <td>
                    @if ($asignacion->bienes_inmuebles_id)
                        Bienes Inmuebles
                    @elseif ($asignacion->bienes_muebles_id)
                        Bienes Muebles
                    @elseif ($asignacion->activos_nubes_id)
                        Activos Nube
                    @endif
                </td>
                <td>{{ $asignacion->fecha_de_asignacion }}</td>
                <td>{{ $asignacion->origen_salida }}</td>
                <td>{{ $asignacion->lugar_asignacion }}</td>
                <td>{{ $asignacion->estado }}</td>
                <td>{{ $asignacion->notas }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>SECCION DE PRESTAMOS</h2>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de Bien</th>
                <th>Lugar de Prestamo</th>
                <th>Fecha de Prestamo</th>
                <th>Estado</th>
                <th>Notas</th>
                <!-- Agrega más encabezados de columna según tus necesidades -->
            </tr>
        </thead>
        <tbody>
        @foreach($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->id }}</td>
                <td>
                    @if ($prestamo->bienes_inmuebles_id)
                        {{ $prestamo->bienesInmuebles->nombre }}
                    @elseif ($prestamo->bienes_muebles_id)
                        {{ $prestamo->bienes_muebles->nombre }}
                    @elseif ($prestamo->activos_nubes_id)
                        {{ $prestamo->activosNubes->nombre }}
                    @endif
                </td>
                <td>
                    @if ($prestamo->bienes_inmuebles_id)
                        {{ $prestamo->bienesInmuebles->descripcion }}
                    @elseif ($prestamo->bienes_muebles_id)
                        {{ $prestamo->bienes_muebles->descripcion }}
                    @elseif ($prestamo->activos_nubes_id)
                        {{ $prestamo->activosNubes->descripcion }}
                    @endif
                </td>
                <td>
                    @if ($prestamo->bienes_inmuebles_id)
                        Bienes Inmuebles
                    @elseif ($prestamo->bienes_muebles_id)
                        Bienes Muebles
                    @elseif ($prestamo->activos_nubes_id)
                        Activos Nube
                    @endif
                </td>
                <td>{{ $prestamo->lugar_de_prestamo }}</td>
                <td>{{ $prestamo->fecha_de_prestamo }}</td>
                <td>{{ $prestamo->estado }}</td>
                <td>{{ $prestamo->notas }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
