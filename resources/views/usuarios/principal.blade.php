@extends('adminlte::page')

@section('title', 'USUARIOS')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="row mt-3">
        
        <div class="col-md-4">
            <button class="btn-primary">
                <a href="/usuarios/crear" style="text-decoration: none; color: black;">NUEVO USUARIO</a>
            </button>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        <input type="text" id="search" class="form-control" placeholder="Buscador Rapido">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="user-table"  >
                    <thead class="thead-primary"><!--con  esto  tendremosel encabezado de color negro-->
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>A_PATERNO</th>
                            <th>A_MATERNO</th>
                            <th>NUM_EMPLEADO</th>
                            <th>TELEFONO</th>
                            <th>CARGO</th>
                            <th>ROL</th>
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
                        <tr style="background-color: {{ $row->is_active == 0 ? '#FA6462' : '' }}">
                            <td>{{ $i++ }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->nombre }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->a_paterno }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->a_materno }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->num_empleado }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->telefono }}</td>
                            <td style="color: {{ $row->is_active == 0 ? 'white' : '' }}">{{ $row->cargo }}</td>
                            <td>
                                @foreach($row->roles as $role)
                                    @if ($role->name === 'superadmin')
                                        <span class="badge" style="background-color: #FF5733;">{{ $role->name }}</span>
                                     @elseif ($role->name === 'administrativo')
                                        <span class="badge" style="background-color: #33FF57;">{{ $role->name }}</span>
                                    @elseif ($role->name === 'seguridad')
                                        <span class="badge" style="background-color: #5733FF;">{{ $role->name }}</span>
                                    @elseif ($role->name === 'comun')
                                        <span class="badge" style="background-color: #33A3FF;">{{ $role->name }}</span>
                                    @endif
                                @endforeach
                            </td>
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
    <style>
        .thead-primary th {
            background-color: #000080;
            color: #ffffff;
        }

        .btn-primary {
            background-color: #D198F1 ;
            border-color: #3498db;
        }
    </style>

    

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
