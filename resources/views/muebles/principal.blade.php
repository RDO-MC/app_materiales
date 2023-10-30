@extends('adminlte::page')

@section('title', 'Bienes Muebles')

@section('content_header')
 <h1>Bienes Muebles</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-6">
            <button>
                <a href="{{ route('muebles.crear') }}" style="text-decoration: none; color: black;">NUEVO</a>
            </button>
        </div>
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Buscar">
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="muebles-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Factura</th>
                            <th>N_Serie</th>
                            <th>Importe</th>
                            <th>Partida</th>
                            <th>Identificación del Bien</th>
                            <th>Marca</th>
                            <th>Estado</th>
                            <th>STATUS</th>
                            <th>IMG</th>
                            <th>QR</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($bienes_muebles as $mueble)
                        <tr style="background-color: {{ $mueble->status == 0 ? 'red' : '' }}">
                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->nombre }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->descripcion }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->factura }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->num_serie }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->importe }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->partida }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->identificacion_del_bien }}</td>
                            <td style="color: {{ $mueble->status == 0 ? 'white' : '' }}">{{ $mueble->marca }}</td>
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
                                <a href="{{ route('muebles.editar', $mueble->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit">Editar</i> 
                                </a>
                            </td>
                            <td>
                            <form id="disable-form-{{ $mueble->id }}" method="POST" action="{{ route('muebles.disable', $mueble->id) }}">
                                @method("PUT")
                                @csrf
                                <button class="btn {{ $mueble->status ? 'btn-danger' : 'btn-success' }}" onclick="return confirmAction({{ $mueble->id }})">
                                    <i class="fas {{ $mueble->status ? 'fa-arrow-down' : 'fa-arrow-up' }}" style="font-size: 10px;">{{ $mueble->status ? 'Baja' : 'Alta' }}</i>
                                    
                                </button>
                                <input type="hidden" name="status" value="{{ $mueble->status ? 0 : 1 }}">
                            </form>  
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
            var mueble = $(this);

            // Concatenamos todos los campos en un solo texto para buscar
            var textToSearch = mueble.text().toLowerCase();

            if (textToSearch.includes(searchTerm)) {
                mueble.show();
            } else {
                mueble.hide();
            }
        });
    });
});


</script>

@stop
