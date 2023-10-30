@extends('adminlte::page')

@section('title', 'Formulario de Asignación')

@section('content_header')
    <h1>Formulario de Asignación</h1>
@stop

@section('content')
<div>
    @if ($usuarioSeleccionado)
        <p>Usuario Seleccionado: {{ $usuarioSeleccionado->nombre }} {{ $usuarioSeleccionado->a_paterno }} {{ $usuarioSeleccionado->a_materno }}</p>
    @else
        <p>No se ha seleccionado un usuario.</p>
    @endif

    <p>Bienes Inmuebles Seleccionados:</p>
    <ul>
        @if (!is_null($bienesInmueblesSeleccionados))
            @foreach ($bienesInmueblesSeleccionados as $bien)
                <li>{{ $bien->nombre }}</li>
            @endforeach
        @else
            <p>No se han seleccionado bienes inmuebles.</p>
        @endif
    </ul>

    @if ($tipoBien === 'bienes_muebles')
        <p>Bienes Muebles Seleccionados:</p>
        <ul>
            @if (!is_null($bienesMueblesSeleccionados))
                @foreach ($bienesMueblesSeleccionados as $bien)
                    <li>{{ $bien->nombre }}</li>
                @endforeach
            @else
                <p>No se han seleccionado bienes muebles.</p>
            @endif
        </ul>
    @endif

    <form method="post" action="{{ route('asignacion.guardar') }}">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="fecha_de_asignacion">Fecha de asignación:</label>
                <input type="date" name="fecha_de_asignacion" class="form-control" id="fecha_de_asignacion" placeholder="Fecha de asignación" size="10" maxlength="10">
            </div>
            <div class="col-md-4">
                <label for="origen_salida">Origen de Salida:</label>
                <textarea name="origen_salida" class="form-control" id="origen_salida" placeholder="Origen de salida"></textarea>
            </div>
            <div class="col-md-4">
                <label for ="lugar_asignacion">Lugar de Asignación:</label>
                <textarea name="lugar_asignacion" class="form-control" id="lugar_asignacion" placeholder="Lugar de asignación"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="estado">Estado:</label>
                <select id="estado" class="form-control" name="estado" required>
                    <option value="nuevo">Nuevo</option>
                    <option value="bueno">Bueno</option>
                    <option value="malo">Malo</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="notas">Notas:</label>
                <textarea name="notas" class="form-control" id="notas" placeholder="Notas"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
            </div>
        </div>
    </form>
</div>
@stop
