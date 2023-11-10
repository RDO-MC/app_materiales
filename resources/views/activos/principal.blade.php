@extends('adminlte::page')

@section('title', 'ACTIVOS NUBE')

@section('content_header')
 <h1>ACTIVOS NUBE </h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-6">
            <button>
                <a href="{{ route('activos.crear') }}" style="text-decoration: none; color: black;">NUEVO</a>
            </button>
        </div>
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
                            <th>EDITAR</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($activos_nube as $activos)

                        <tr style="background-color: {{ $activos->status == 0 ? 'red' : ($activos->status == 2 ? 'lightgreen' : ($activos->status == 3 ? 'lightblue' : 'white')) }}">


                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->fecha_adquisicion}}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->fecha_vencimiento }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->version }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_conac }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_inventario_sefiplan }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->cve_inventario_interno }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->nombre }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->descripcion }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->factura }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->num_serie }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->importe }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->partida }}</td>
                            <td style="color: {{ $activos->status == 0 ? 'white' : '' }}">{{ $activos->identificacion_del_bien }}</td>
                            
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
                            @if ($activos->status !=0 && $activos->status != 2 && $activos->status != 3)
                                    <a href="{{ route('activos.editar', $activos->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit">Editar</i> 
                                    </a>
                                @endif
                            </td>
                            <td>
                            @if ($activos->status != 2 && $activos->status != 3)
                                    <form id="disable-form-{{ $activos->id }}" method="POST" action="{{ route('activos.disable', $activos->id) }}">
                                        @method("PUT")
                                        @csrf
                                        <button class="btn {{ $activos->status ? 'btn-danger' : 'btn-success' }}" onclick="return confirmAction({{ $activos->id }})">
                                            <i class="fas {{ $activos->status ? 'fa-arrow-down' : 'fa-arrow-up' }}" style="font-size: 10px;">{{ $activos->status ? 'Baja' : 'Alta' }}</i>
                                        </button>
                                        <input type="hidden" name="status" value="{{ $activos->status ? 0 : 1 }}">
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

@stop
