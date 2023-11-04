@extends('adminlte::page')

@section('title', 'ASIGNACIONES')

@section('content')
<div class="text-center">
    <form method="GET" action="{{ route('asignacion.index') }}" class="mb-0">
        <div class="form-inline">
            <input type="text" name="q" placeholder="Buscar usuario" class="form-control" style="width: 200px;">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
</div>
<div class="text-center">
    @if ($usuarioSeleccionado)
    <!-- Mostrar detalles del usuario seleccionado solo si se ha realizado una búsqueda -->
    <div class="user-details-box" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9;">
        <h2 style="font-size: 1.5rem; margin-bottom: 10px;">Detalles del Usuario Seleccionado</h2>
        <div class="user-details">
            <p><strong>Nombre:</strong> {{ $usuarioSeleccionado->nombre }}</p>
            <p><strong>Apellido Paterno:</strong> {{ $usuarioSeleccionado->a_paterno }}</p>
            <p><strong>Apellido Materno:</strong> {{ $usuarioSeleccionado->a_materno }}</p>
            <p><strong>Número de Empleado:</strong> {{ $usuarioSeleccionado->num_empleado }}</p>
            <!-- Agrega más detalles aquí si es necesario -->
        </div>
    </div>
    @if ($usuarioInactivo)
    <script>
        $(document).ready(function() {
            alert("Usuario inactivo. No puedes continuar con la asignación. Por favor, busca otro usuario.");
        });
    </script>
    @else
<<<<<<< HEAD
    <form method="post" action="{{ route('asignacion.guardarTipoBien') }}">
=
        @csrf

        <input type="hidden" name="user_id" value="{{ $usuarioSeleccionado->id }}">

        <div class="form-group">
        <label for="tipo_bien">Tipo de Bien:</label>

        <select name="tipo_bien" id="tipo_bien" class="form-control" style="width: 200px;">
            <option value="bienes_muebles">Bienes Muebles</option>
            <option value="bienes_inmuebles">Bienes Inmuebles</option>
            <option value="activos_nube">Activos en la Nube</option>
        </select>
        </div>

        <button type="submit" class="btn btn-primary">Continuar</button>

        </form>
    @endif
    @endif
</div>
@stop
