@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <button>
                <a href="/usuarios/crear" style="text-decoration: none; color: black;">Crear Usuario</a>
            </button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                            <th>CONTRASEÑA</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @foreach($users as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->nombre }}</td>
                                <td>{{ $row->a_paterno}}</td>
                                <td>{{ $row->a_materno }}</td>
                                <td>{{ $row->num_empleado }}</td>
                                <td>{{ $row->telefono }}</td>
                                <td>{{ $row->cargo }}</td>
                                <td>{{ $row->campus }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->password }}</td>
                                <td>
                                    <a href="{{ url('users/'.$row->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('users/'.$row->id) }}">
                                        @method("DELETE")
                                        @csrf
                                        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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
    <script> console.log('Hi!'); </script>
@stop
