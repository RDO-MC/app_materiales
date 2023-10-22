@extends('adminlte::page')

@section('title', 'BIENES_INMUEBLES')

@section('content_header')
    <h1>BIENES INMUEBLES</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <button>
                <a href="/inmuebles/crear" style="text-decoration: none; color: black;">NUEVO</a>
            </button>
        </div>
    </div>

    <input type="text" id="search" class="form-control" placeholder="Buscar">

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="bienes_inmuebles-table" >
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
                            <th>EDITAR</th>
                            <th>BAJA</th>
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
                                <img src="{{ $row->img_url }}" alt="Imagen del bien inmueble" style="max-width: 100px; max-height: 100px;">
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
                                <a href="{{ route('inmuebles.editar', $row->id) }}" class="btn btn-warning">
                        
                                <i class="fas fa-edit">Editar</i> 
                            </a>

                                </td>
                                
                                
                                
                                <td>
                                    <form id="disable-form-{{ $row->id }}" method="POST" action="{{ route('inmuebles.disable', $row->id) }}">
                                        @method("PUT")
                                        @csrf
                                        <button class="btn {{ $row->status ? 'btn-danger' : 'btn-success' }}" onclick="confirmAction({{ $row->id }})">
                                            <i class="fas {{ $row->status ? 'fa-trash' : 'fa-check' }}" style="font-size: 8px;"> {{ $row->status ? 'Baja' : 'Alta' }}</i>
                                        </button>
                                        <input type="hidden" name="status" value="{{ $row->status ? 0 : 1 }}">
                                        <input type="hidden" id="nota_{{ $row->id }}" name="nota" value="">
                                    </form>
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

@stop
