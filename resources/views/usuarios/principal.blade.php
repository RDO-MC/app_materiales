@extends('adminlte::page')

@section('title', 'USUARIOS')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <button>
                <a href="/usuarios/crear" style="text-decoration: none; color: black;">NUEVO</a>
            </button>
        </div>
    </div>

    <input type="text" id="search" class="form-control" placeholder="Buscar">

  

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="user-table" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>A_PATERNO</th>
                            <th>A_MATERNO</th>
                            <th>NUM_EMPLEADO</th>
                            <th>TELEFONO</th>
                            <th>CARGO</th>
                            <th>CAMPUS</th>
                            <th>CORREO</th>
                            <th>ESTADO</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($users as $row)
                        <tr style="background-color: {{ $row->is_active == 0 ? 'red' : '' }}">
                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->nombre }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->a_paterno }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->a_materno }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->num_empleado }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->telefono }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->cargo }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->campus }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->email }}</td>
                            <td>
                                @if ($row->is_active == 0)
                                    Inactivo
                                @else
                                    Activo
                                @endif
                            </td>
                                 <td>
                                    @if ($row->is_active == 1) {{-- Solo mostrar el botón de editar si el usuario está activo --}}
                                        <a href="{{ route('usuarios.editar', $row->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit">Editar</i> 
                                        </a>
                                    @endif
                                </td>
                                <td>
                                
                                <form id="disable-form-{{ $row->id }}" method="POST" action="{{ route('usuarios.disable', $row->id) }}">
                                    @method("PUT")
                                    @csrf
                                    <button class="btn {{ $row->is_active ? 'btn-danger' : 'btn-success' }}" onclick="return confirmAction({{ $row->id }})">
                                        <i class="fas {{ $row->is_active ? 'fa-trash' : 'fa-check' }}" style="font-size: 8px;"></i>
                                        {{ $row->is_active ? 'Baja' : 'Alta' }}
                                    </button>
                                    <input type="hidden" name="is_active" value="{{ $row->is_active ? 0 : 1 }}">
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

        $("#user-table tbody tr").each(function() {
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
    function confirmAction(userId, isActive) {
        var action = isActive ? 'dar de baja' : 'dar de alta';
        var confirmationMessage = '¿Estás seguro de que deseas ' + action + ' a este usuario?';

        if (confirm(confirmationMessage)) {
            document.getElementById('disable-form-' + userId).submit();
        } else {
            // El usuario canceló la acción
            return false;
        }
    }
</script>


@stop
