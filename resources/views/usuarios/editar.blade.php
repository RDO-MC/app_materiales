@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                    <form id="editar-usuario-form" method="POST" action="{{ route('usuarios.update', $user->id) }}">
    <!-- ... Campos de edición ... -->
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('nombre') }}</label>
                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $user->nombre }}" required autofocus>
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="a_paterno" class="col-md-4 col-form-label text-md-end">{{ __('a_paterno') }}</label>
                                <div class="col-md-6">
                                    <input id="a_paterno" type="text" class="form-control @error('a_paterno') is-invalid @enderror" name="a_paterno" value="{{ $user->a_paterno }}" required autofocus>
                                    @error('a_paterno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="a_materno" class="col-md-4 col-form-label text-md-end">{{ __('a_materno') }}</label>
                                <div class="col-md-6">
                                    <input id="a_materno" type="text" class="form-control @error('a_materno') is-invalid @enderror" name="a_materno" value="{{ $user->a_materno }}" required autofocus>
                                    @error('a_materno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="num_empleado" class="col-md-4 col-form-label text-md-end">{{ __('num_empleado') }}</label>
                                <div class="col-md-6">
                                    <input id="num_empleado" type="text" class="form-control @error('num_empleado') is-invalid @enderror" name="num_empleado" value="{{ $user->num_empleado }}" required autofocus>
                                    @error('num_empleado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('telefono') }}</label>
                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $user->telefono }}" required autofocus>
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="cargo" class="col-md-4 col-form-label text-md-end">{{ __('cargo') }}</label>
                                <div class="col-md-6">
                                    <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ $user->cargo }}" required autofocus>
                                    @error('cargo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="campus" class="col-md-4 col-form-label text-md-end">{{ __('campus') }}</label>
                                <div class="col-md-6">
                                    <input id="campus" type="text" class="form-control @error('campus') is-invalid @enderror" name="campus" value="{{ $user->campus }}" required autofocus>
                                    @error('campus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           
                            <!-- Repite los campos para editar la información del usuario (a_paterno, a_materno, num_empleado, etc.) -->


                        <button type="submit" class="btn btn-primary" id="btn-actualizar-usuario">{{ __('Actualizar Usuario') }}</button>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnActualizarUsuario = document.getElementById('btn-actualizar-usuario');
    
    btnActualizarUsuario.addEventListener('click', function(event) {
        event.preventDefault(); // Previene el envío del formulario por defecto
        
        if (confirm('¿Estás seguro de que deseas actualizar los datos?')) {
            // Si el usuario confirma, envía el formulario
            const editarUsuarioForm = document.getElementById('editar-usuario-form');
            editarUsuarioForm.submit();
        } else {
            window.location.href = '{{ route('usuarios.principal') }}';
        }
    });
});
</script>

@stop
