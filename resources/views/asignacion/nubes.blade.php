@extends('adminlte::page')

@section('title', 'ACTIVOS NUBE')

@section('content_header')
 <h1>ACTIVOS NUBE</h1>
@stop

@section('content')
@php
    $user_id = Session::get('user_id');
    $activosNubesSeleccionados = null; // Asigna un valor apropiado aquí si es necesario
@endphp


<form method="POST" action="{{ route('asignacion.proceso2') }}">

    @csrf
    
    <input type="hidden" name="user_id" value="{{ $user_id }}">
   
    <!-- Agrega un campo oculto para almacenar los bienes inmuebles seleccionados -->
    <input type="hidden" name="selected_bienes" id="selectedBienes" value="">
    <button type="submit" class="btn btn-primary">Continuar</button>
</form>

        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Buscar">
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="activos_nube">
                    <thead>
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
    $(document).ready(function() {
    $("#search").on("input", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("#muebles-table tbody tr").each(function() {
            var activos = $(this);

            // Concatenamos todos los campos en un solo texto para buscar
            var textToSearch = activos.text().toLowerCase();

            if (textToSearch.includes(searchTerm)) {
                activos.show();
            } else {
                activos.hide();
            }
        });
    });
});
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
