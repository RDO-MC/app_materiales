@extends('adminlte::page')

@section('title', 'BIENES_INMUEBLES')

@section('content_header')
    <h1>BIENES INMUEBLES</h1>
@stop

@section('content')
@php
    $user_id = Session::get('user_id');
    $bienesInmueblesSeleccionados = null; // Asigna un valor apropiado aquí si es necesario
@endphp


<form method="POST" action="{{ route('asignacion.proceso') }}">
    @csrf
    
    <input type="hidden" name="user_id" value="{{ $user_id }}">
   
    <!-- Agrega un campo oculto para almacenar los bienes inmuebles seleccionados -->
    <input type="hidden" name="selected_bienes" id="selectedBienes" value="">
    <button type="submit" class="btn btn-primary">Continuar</button>
</form>

<input type="text" id="search" class="form-control" placeholder="Buscar">

<div class="row mt-3">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="bienes_inmuebles-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>NUM_ESCRITURA_PROPIEDAD</th>
                        <th>INS_REG_PUB</th>
                        <th>ESTADO_VALUADO</th>
                        <th>REGISTRO_CONTABLE</th>
                        <th>NUM_CEDULA_CATASTRAL</th>
                        <th>VAL_CATASTRAL</th>
                        <th>VAL_COMERCIAL</th>
                        <th>IMG_URL</th>
                        <th>QR</th>
                        <th>ESTADO</th>
                        <th>NOTAS</th>
                        <th>STATUS</th>
                        <th>ASIGNAR</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach($bienes_inmuebles as $row)
                    <tr style="background-color: {{ $row->status == 0 ? 'red' : '' }}">
                        <td>{{ $i++ }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->nombre }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->descripcion }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->num_escritura_propiedad }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->ins_reg_pub_prop}}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->estado_valuado }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->registro_contable }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->num_cedula_catastral }}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->val_catastral}}</td>
                        <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->val_comercial}}</td>
                        <td>
                            <img src="{{ asset($row->img_url) }}" alt="Imagen del bien inmueble" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>
                            <img src="{{ $row->qr }}" alt="Imagen del qr" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td style="color: {{ $row->status== 0 ? 'white' : '' }}">{{ $row->estado}}</td>
                        <td style="color: {{ $row->status== 0 ? 'white' : '' }}">{{ $row->nota}}</td>
                        <td>
                            @if ($row->status == 0)
                                Inactivo
                            @else
                                Activo
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-success" id="selectButton_{{ $row->id }}" data-id="{{ $row->id }}" onclick="toggleSelection(this)">
                                <span id="selectText_{{ $row->id }}">Seleccionar</span>
                            </button>
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
    $(document).ready(function() {
        $("#search").on("input", function() {
            var searchTerm = $(this).val().toLowerCase();

            $("#bienes_inmuebles-table tbody tr").each(function() {
                var row = $(this);

                // Concatenamos todos los campos en un solo texto para buscar
                var textToSearch = row.text().toLowerCase();

                if (textToSearch.includes(searchTerm)) {
                    row.show();
                } else {
                    row.hide();
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
