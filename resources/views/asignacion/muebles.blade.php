@extends('adminlte::page')

@section('title', 'BIENES MUEBLES')

@section('content_header')
    <div class="text-center">
        <h1>BIENES MUEBLES</h1>  
    </div> 
@stop
 
@section('content')
@php
    $user_id = Session::get('user_id');
    $bienesMueblesSeleccionados = null; // Asigna un valor apropiado aquí si es necesario
@endphp

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por Nombre, Descripción o CVE Inventario Interno">
        </div>
    </div>
    <div class="col-md-6 text-right">
        <form method="POST" action="{{ route('asignacion.proceso1') }}" onsubmit="return validateSelection()">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <!-- Agrega un campo oculto para almacenar los bienes inmuebles seleccionados -->
            <input type="hidden" name="selected_bienes" id="selectedBienes" value="">
            <button type="submit" class="btn btn-primary">Continuar</button>
        </form>
    </div>
</div>


<div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="muebles-table">
                 <thead style="background-color: #0E1264; color: white;">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>cve invenatrio interno</th>
                            <th>Factura</th>
                            <th>N_Serie</th>
                            <th>Importe</th>
                            <th>Partida</th>
                            <th>Identificación del Bien</th>
                            <th>Estado</th>
                            <th>STATUS</th>
                            <th>IMG</th>
                            <th>QR</th>
                            <th>Asignacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($bienes_muebles as $mueble)
                        <tr style="background-color: {{ $mueble->status == 0 ? 'red' : '' }}">
                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->nombre }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->descripcion }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->cve_inventario_interno}}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->factura }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->num_serie }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->importe }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->partida }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->identificacion_del_bien }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->estado }}</td>
                            
                            <td>
                                @if ($mueble->status == 0)
                                    Inactivo
                                @else
                                    Activo
                                @endif
                            </td>
                            
                            <td>
                                @if ($mueble->img_url)
                                    <img src="{{ asset($mueble->img_url) }}" alt="{{ $mueble->nombre }}" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No se ha cargado una imagen
                                @endif
                            </td>
                            <td>
                            <img src="{{ $mueble->qr }}" alt="Imagen del qr" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                <button class="btn btn-success" id="selectButton_{{ $mueble->id }}" data-id="{{ $mueble->id }}" onclick="toggleSelection(this)">
                                    <span id="selectText_{{ $mueble->id }}">Seleccionar</span>
                                </button>

                            </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(document).ready(function () {
        $("#search").on("input", function () {
            var searchTerm = $(this).val().toLowerCase();

            $("table tbody tr").each(function () {
                var row = $(this);
                var columns = row.find('td'); // Obtén todas las columnas de la fila

                var found = false;

                // Itera sobre las columnas y verifica si alguna contiene el término de búsqueda
                columns.each(function () {
                    var textToSearch = $(this).text().toLowerCase();
                    if (textToSearch.includes(searchTerm)) {
                        found = true;
                        return false; // Sale del bucle si se encuentra una coincidencia en alguna columna
                    }
                });

                // Muestra u oculta la fila según si se encontró una coincidencia
                found ? row.show() : row.hide();
            });
        });
    });
</script>
<script>
    function validateSelection() {
        // Check if there are any selected bienes inmuebles
        if (selectedBienes.length === 0) {
            alert('Por favor, selecciona al menos un bien mueble antes de continuar.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>

<script>
    // Inicializa un array para almacenar los IDs de los bienes inmuebles seleccionados
    let selectedBienes = [];

    function toggleSelection(button) {
        const buttonId = button.getAttribute('data-id');
        const buttonText = document.getElementById(`selectText_${buttonId}`);

        if (buttonText.innerHTML === 'Seleccionar') {
            // Agrega el ID del bien inmueble al array de selección
            selectedBienes.push(buttonId);
            // Cambiar el texto a "Seleccionado" cuando se presiona el botón
            buttonText.innerHTML = 'Seleccionado';
            // Cambia el estilo del botón a amarillo
            button.classList.remove('btn-success');
            button.classList.add('btn-warning');
        } else {
            // Elimina el ID del bien inmueble del array de selección
            selectedBienes = selectedBienes.filter(id => id !== buttonId);
            // Cambiar el texto a "Seleccionar" si ya está seleccionado
            buttonText.innerHTML = 'Seleccionar';
            // Revertir el estilo del botón a su estado original
            button.classList.remove('btn-warning');
            button.classList.add('btn-success');
        }

        // Actualiza el campo oculto con los bienes inmuebles seleccionados
        document.getElementById('selectedBienes').value = selectedBienes.join(',');
    }
</script>

@stop
