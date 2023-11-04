@extends('adminlte::page')

@section('title', 'Formulario de Asignación')

@section('content_header')
    <h1>Formulario de Asignación</h1>
@stop

@section('content')
<<<<<<< HEAD
    <div>
        @if ($usuarioSeleccionado)
            <p>Usuario Seleccionado: {{ $usuarioSeleccionado->nombre }} {{ $usuarioSeleccionado->a_paterno }} {{ $usuarioSeleccionado->a_materno }}</p>
        @else
            <p>No se ha seleccionado un usuario.</p>
        @endif

        @if ($tipo_bien === 'bienes_inmuebles')
            <p>Bienes Inmuebles Seleccionados:</p>
            <ul>
                @foreach ($bienesSeleccionados as $bien)
                    <li>{{ $bien->nombre }} - {{ $bien->descripcion }}</li>
                @endforeach
            </ul>
        @elseif ($tipo_bien === 'bienes_muebles')
            <p>Bienes Muebles Seleccionados:</p>
            <ul>
                @foreach ($bienesSeleccionados as $mueble)
                    <li>{{ $mueble->nombre }} - {{ $mueble->descripcion }}</li>
                @endforeach
            </ul>
        @endif

        <!-- Agrega un formulario para capturar datos adicionales -->
        <form method="post" action="{{ route('asignacion.guardar') }}">
            @csrf
            <input type="hidden" name="tipo_bien" value="{{ $tipo_bien }}"> <!-- Agrega este campo oculto -->
            <!-- Campos comunes a todos los tipos de bienes -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="fecha_de_asignacion">Fecha de asignación:</label>
                    <input type="date" name="fecha_de_asignacion" class="form-control" id="fecha_de_asignacion" placeholder="Fecha de asignación" size="10" maxlength="10">
                </div>
                <div class="col-md-4">
                    <label for="origen_salida">Origen de Salida</label>
                    <textarea name="origen_salida" class="form-control" id="origen_salida" placeholder="Origen de salida"></textarea>
                </div>
                <div class="col-md-4">
                    <label for="lugar_asignacion">Lugar de Asignación</label>
                    <textarea name ="lugar_asignacion" class="form-control" id="lugar_asignacion" placeholder="Lugar de asignación"></textarea>
                </div>
            </div>

            <!-- Campos específicos para bienes inmuebles -->
            @if ($tipo_bien === 'bienes_inmuebles')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="campo_especifico_inmuebles">Campo Específico para Inmuebles:</label>
                        <input type="text" name="campo_especifico_inmuebles" class="form-control" id="campo_especifico_inmuebles" placeholder="Campo Específico">
                    </div>
                </div>
            @endif

            <!-- Campos específicos para bienes muebles -->
            @if ($tipo_bien === 'bienes_muebles')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="campo_especifico_muebles">Campo Específico para Muebles:</label>
                        <input type="text" name="campo_especifico_muebles" class="form-control" id="campo_especifico_muebles" placeholder="Campo Específico">
                    </div>
                </div>
            @endif

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="estado" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>
                    <div class="col-md-13">
                        <select id="estado" class="form-control" name="estado" required onchange="mostrarOtroEstado(this)">
                            <option value="Bien_Mantenido">Bien mantenido</option>
                            <option value="Necesita_Reparacion">Necesita Reparación</option>
                            <option value="Desgastado">Desgastado</option>
                        </select>
                        @error('estado')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="notas">Notas</label>
                    <textarea name="notas" class="form-control" id="notas" placeholder="Notas"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12 text-right"> <!-- Alineación a la derecha -->
                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button> <!-- Tamaño grande -->
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

