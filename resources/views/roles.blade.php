@extends('layouts.app')  <!-- Asegúrate de que estás utilizando el diseño adecuado -->

@section('content')
    <div class="col-md-6">
        <form action="{{ route('guardar_rol') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="role">Seleccione un rol:</label>
                <select id="role" name="role" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
