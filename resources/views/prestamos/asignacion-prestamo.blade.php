@extends('adminlte::page')

@section('title', 'Préstamo ')

@section('content_header')
    <h2>Préstamos</h2>
@stop

@section('content')
    <div class="card">
        <div class="card-header">{{ __('') }}</div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('administrativo.guardarPrestamo') }}">
                @csrf

                <!-- Campos ocultos para pasar información al controlador -->
                <input type="hidden" name="id_bien" value="{{ $asignacion->id }}">
                <input type="hidden" name="tipo_bien" value="{{ $asignacion->tipo_bien }}">
                <!-- Campo oculto para almacenar el ID del usuario -->
                <input type="hidden" id="id_usuario" name="usuario_id">

                <!-- Muestra la información del bien -->
                <div class="row mb-3">
                    <label class="col-md-2 col-form-label text-md-end">{{ __('Bien a prestar') }}</label>
                    <div class="col-md-8">
                        <p><strong>Nombre:</strong>
                            @if ($asignacion->bienes_inmuebles_id)
                                {{ $asignacion->bienesInmuebles->nombre }}
                            @elseif ($asignacion->bienes_muebles_id)
                                {{ $asignacion->bienesMuebles->nombre }}
                            @elseif ($asignacion->activos_nubes_id)
                                {{ $asignacion->activosNubes->nombre }}
                            @endif
                        </p>
                        <p><strong>Descripción:</strong>
                            @if ($asignacion->bienes_inmuebles_id)
                                {{ $asignacion->bienesInmuebles->descripcion }}
                            @elseif ($asignacion->bienes_muebles_id)
                                {{ $asignacion->bienesMuebles->descripcion }}
                            @elseif ($asignacion->activos_nubes_id)
                                {{ $asignacion->activosNubes->descripcion }}
                            @endif
                        </p>
                        <!-- Puedes agregar más detalles según sea necesario -->
                    </div>
                </div>

                <!-- Campo de entrada para el número de empleado -->
                <div class="row mb-3">
                    <label for="numero_empleado" class="col-md-2 col-form-label text-md-end">{{ __('Número de Empleado') }}</label>
                    <div class="col-md-8">
                        <input type="text" id="numero_empleado" name="numero_empleado" class="form-control" required>
                    </div>
                </div>

                <!-- Campo de salida para mostrar el nombre y apellidos del usuario -->
                <div class="row mb-3">
                    <label for="nombre_usuario" class="col-md-2 col-form-label text-md-end">{{ __('Nombre del Usuario') }}</label>
                    <div class="col-md-8">
                        <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="lugar_de_prestamo" class="col-md-2 col-form-label text-md-end">{{ __('Lugar de Préstamo') }}</label>
                    <div class="col-md-8">
                        <input id="lugar_de_prestamo" type="text" class="form-control @error('lugar_de_prestamo') is-invalid @enderror" name="lugar_de_prestamo" required>
                        @error('lugar_de_prestamo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="notas" class="col-md-2 col-form-label text-md-end">{{ __('Notas') }}</label>
                    <div class="col-md-8">
                        <input id="notas" type="text" class="form-control @error('notas') is-invalid @enderror" name="notas">
                        @error('notas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="estado" class="col-md-2 col-form-label text-md-end">{{ __('Estado') }}</label>
                    <div class="col-md-8">
                        <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Malo">Malo</option>
                            <option value="Otro">Otro</option>
                        </select>
                        @error('estado')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fecha_de_prestamo" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Préstamo') }}</label>
                    <div class="col-md-8">
                        <input id="fecha_de_prestamo" type="date" class="form-control @error('fecha_de_prestamo') is-invalid @enderror" name="fecha_de_prestamo" required>
                        @error('fecha_de_prestamo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fecha_de_devolucion" class="col-md-2 col-form-label text-md-end">{{ __('Fecha de Devolución') }}</label>
                    <div class="col-md-8">
                        <input id="fecha_de_devolucion" type="date" class="form-control @error('fecha_de_devolucion') is-invalid @enderror" name="fecha_de_devolucion" required>
                        @error('fecha_de_devolucion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Agrega aquí los demás campos del formulario según tus necesidades -->

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Crear Préstamo') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <!-- Agrega el enlace a jQuery aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#numero_empleado").on("blur", function () {
                var numeroEmpleado = $(this).val();

                // Realiza una llamada AJAX para obtener la información del usuario
                $.ajax({
                    url: '/buscar-usuario/' + numeroEmpleado,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // Rellena el campo de salida con el nombre y apellidos del usuario
                        $("#nombre_usuario").val(data.nombre + ' ' + data.apellidos);

                        // Almacena el ID del usuario en un campo oculto
                        $("#id_usuario").val(data.id);
                    },
                    error: function (xhr, status, error) {
                        // Maneja el error de manera más elegante, por ejemplo, mostrando un mensaje en la interfaz de usuario
                        $("#nombre_usuario").val('Usuario no encontrado');
                    }
                });
            });
        });
    </script>
@stop
