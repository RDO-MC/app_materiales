@extends('adminlte::page')

@section('title', 'BIENES_INMUEBLES')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
        <h1>BIENES INMUEBLES  </h1>
        <a href="{{ route('inmuebles.qr') }}" class="btn btn-info">Imprimir QR</a>
    </div>
@stop

@section('content')

<div class="row mt-3">
    <div class="col-md-6">
        <button class="btn btn-primary">
                <a href="{{ route('inmuebles.crear') }}" style="text-decoration: none; color: white;">NUEVO INMUEBLE</a>
        </button>
    </div>
    <div class="col-md-6">
        <input type="text" id="search" class="form-control" placeholder="Buscar">
    </div>
</div>
   
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="bienes_inmuebles-table" >
                <thead style="background-color: #0E1264; color: white;">
                        <tr>
                            <th>#</th>
                            <th>FECHA</th>
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
                            <th>STATUS</th>
                            <th>EDITAR</th>
                            <th>BAJA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($bienes_inmuebles as $row)
                        <tr style="background-color: {{ $row->status == 0 ? 'red' : ($row->status == 2 ? 'lightgreen' : ($row->status == 3 ? 'lightblue' : 'white')) }}">

                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->fecha }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->nombre }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">
                                <?php
                                    $descripcion = $row->descripcion;
                                    $descripcion_abreviada = str_word_count($descripcion, 1, 'áéíóúÁÉÍÓÚ'); // Dividir la descripción en palabras
                                    $descripcion_abreviada = implode(' ', array_slice($descripcion_abreviada, 0, 20)); // Tomar solo las primeras 20 palabras
                                ?>
                                <span class="descripcion_abreviada">{{ $descripcion_abreviada }}</span>
                                @if (str_word_count($descripcion) > 20)
                                    <span class="ver-mas" style="cursor: pointer; color: blue;">...Ver más</span>
                                    <span class="descripcion-completa" style="display: none;">{{ substr($descripcion, strlen($descripcion_abreviada)) }}</span>
                                @endif
                            </td>

                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->num_escritura_propiedad }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->ins_reg_pub_prop}}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->estado_valuado }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->registro_contable }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->num_cedula_catastral }}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->val_catastral}}</td>
                            <td style="color: {{ $row->status == 0 ? 'white' : '' }}">{{ $row->val_comercial}}</td>
                            <td>
                                <img src="{{ $row->img_url }}" alt="Imagen del bien inmueble" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                            <img src="{{ $row->qr }}" alt="Imagen del qr" style="max-width: 100px; max-height: 100px;">
                            </td>

                            <td style="color: {{ $row->status== 0 ? 'white' : '' }}">{{ $row->estado}}</td>
                             
                            <td>
                                @if ($row->status == 0)
                                    INACTIVO
                                    @elseif ($row->status == 1)
                                    ACTIVO
                                    @elseif($row->status == 2)
                                    PRESTADO
                                @else
                                    ASIGNADO
                                @endif
                            </td>
                           
                                <td>
                            
                                @if ($row->status !=0 &&$row->status != 2 && $row->status != 3)
                             <a href="{{ route('inmuebles.editar', $row->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit">Editar</i> 
                            </a>
                            @endif
                                </td>
                                
                                 
                                
                                <td>
                                @if ($row->status != 2 && $row->status != 3)
                                    <form id="disable-form-{{ $row->id }}" method="POST" action="{{ route('inmuebles.disable', $row->id) }}">
                                        @method("PUT")
                                        @csrf
                                        <button class="btn {{ $row->status ? 'btn-danger' : 'btn-success' }}" onclick="confirmAction({{ $row->id }})">
                                            <i class="fas {{ $row->status ? 'fa-trash' : 'fa-check' }}" style="font-size: 8px;"> {{ $row->status ? 'Baja' : 'Alta' }}</i>
                                        </button>
                                        <input type="hidden" name="status" value="{{ $row->status ? 0 : 1 }}">
                                        <input type="hidden" id="nota_{{ $row->id }}" name="nota" value="">
                                    </form>
                                    @endif
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
    function confirmAction(id) {
        var action = 'dar de baja';
        if (confirm('¿Estás seguro de ' + action + ' este bien inmueble?')) {
            var nota = prompt('Por favor, ingresa el motivo o nota:');
            if (nota !== null) {
                // Establece el motivo en el formulario oculto
                document.getElementById('nota_' + id).value = nota;
                document.getElementById('disable-form-' + id).submit();
            }
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.ver-mas').forEach(function(element) {
            element.addEventListener('click', function() {
                var descripcionAbreviada = this.previousElementSibling;
                var descripcionCompleta = this.nextElementSibling;

                descripcionAbreviada.style.display = 'none';
                descripcionCompleta.style.display = 'inline';

                this.style.display = 'none';
            });
        });
    });
</script>


@stop
