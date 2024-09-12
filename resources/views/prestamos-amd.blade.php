@extends('adminlte::page')

@section('title', 'MATERIALES ')

@section('content')
    <div class="text-center">
        <h2>MATERIALES PRESTADOS</h2>
    </div>

    <table class="table">
        <thead style="background-color: #0E1264; color: white;">
            <tr>
                <th>#</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>TIPO DE BIEN</th>
                <th>LUGAR DE PRESTAMO</th>
                <th>FECHA DE PRESTAMO</th>
                <th>FECHA DE DEVOLUCION</th>
                <th>NOTAS</th>
                <!-- Agrega más encabezados de columna según tus necesidades -->
            </tr>
        </thead>
        <tbody>
        @foreach($prestamos as $prestamo)
            <tr>
                <td>{{ $prestamo->id }}</td>
                <td>
                    @if ($prestamo->bienes_inmuebles_id)
                        {{ $prestamo->bienes_inmuebles->nombre }}
                    @elseif ($prestamo->bienes_muebles_id)
                        {{ $prestamo->bienes_muebles->nombre }}
                    @elseif ($prestamo->activos_nubes_id)
                        {{ $prestamo->activosNubes->nombre }}
                    @endif
                </td>
                <td>
                    @if ($prestamo->bienes_inmuebles_id)
                        {{ $prestamo->bienes_inmuebles->descripcion }}
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
                <td>{{ $prestamo->fecha_de_devolucion }}</td>
                <td>{{ $prestamo->notas }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
