@extends('adminlte::page')

@section('title', 'ACTIVOS NUBE')
 
@section('content_header')
    <div class="text-center">
        <h1>ACTIVOS EN LA NUBE</h1>  
    </div>  
@stop

@section('content')
@php
    $user_id = Session::get('user_id');
    $activosNubesSeleccionados = null; // Asigna un valor apropiado aquí si es necesario
@endphp


<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="search" class="form-control" placeholder="Buscar por Nombre, Descripción o CVE Inventario Interno">
        </div>
    </div>

    <div class="col-md-6 text-right">
        <form   form method="POST" action="{{ route('asignacion.proceso2') }}" onsubmit="return validateSelection()">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
             <!-- Cambia el tipo del campo oculto a text -->
            <input type="text" name="selected_bienes" id="selectedBienes" value="" style="display: none">
             <button type="submit" class="btn btn-primary">Continuar</button>
        </form>
    </div>
</div>


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="activos_nube">
                <thead style="background-color: #0E1264; color: white;">
                        <tr>
                            <th>#</th>
                            <th>FECHA DE ADQUISICION</th>
                            <th>FECHA DE VENCIMIENTO</th>
                            <th>VERSION</th>
                            <th>CVE CONAC</th>
                            <th>CVE INVENTARIO SEFIPLAN</th>
                            <th>CVE INVENTARIO INTERNO</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCION</th>
                            <th>FACTURA</th>
                            <th>NUM. SERIE</th>
                            <th>IMPORTE</th>
                            <th>PARTIDA</th>
                            <th>IDENTIFICACION DEL BIEN</th>
                            <th>STATUS</th>
                            <th>IMG</th>
                            <th>QR</th>
                            <th>ASIGNACION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($activos_nubes as $activos)

                        <tr style="background-color: {{ $activos->status == 0 ? 'red' : ($activos->status == 2 ? 'lightgreen' : ($activos->status == 3 ? 'lightblue' : 'white')) }}">
                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->fecha_adquisicion}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->fecha_vencimiento}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->version}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_conac}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_inventario_sefiplan}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_inventario_interno}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->nombre}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->descripcion}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->factura}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->num_serie}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->importe}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->partida}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->identificacion_del_bien}}</td>
                            
                            <td>
                                @if ($activos->status == 0)
                                   INACTIVO
                                @elseif ($activos->status == 1)
                                    ACTIVO
                                @elseif ($activos->status == 2)
                                    PRESTADO
                                @else
                                    ASIGNADO
                                @endif
                            </td>
                            <td>
                                @if ($activos->img_url)
                                    <img src="{{ asset($activos->img_url) }}" alt="{{ $activos->nombre }}" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No se ha cargado una imagen
                                @endif
                            </td> 
                            <td>
                                <img src="{{ $activos->qr }}" alt="Imagen del qr" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                <button class="btn btn-success" id="selectButton_{{ $activos->id }}" data-id="{{ $activos->id }}" onclick="toggleSelection(this)">
                                    <span id="selectText_{{ $activos->id }}">Seleccionar</span>
                                </button>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

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
            alert('Por favor, selecciona al menos un activo nube antes de continuar.');
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
