@extends('adminlte::page')

@section('content')
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('REGISTRAR NUEVO USUARIO ') }}</div>

                    <div class="card-body">
                        
                        <form id="crear-usuario-form"  method="POST" action="{{ route('usuarios.store') }}">
                            @csrf
                            <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('NOMBRE') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="a_paterno" class="col-md-4 col-form-label text-md-end">{{ __('APELLIDO PATERNO') }}</label>

                            <div class="col-md-6">
                                <input id="a_paterno" type="text" class="form-control @error('a_paterno') is-invalid @enderror" name="a_paterno" value="{{ old('a_paterno') }}" required autocompletea_paterno" autofocus>

                                @error('a_paterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="a_materno" class="col-md-4 col-form-label text-md-end">{{ __('APELLIDO MATERNO') }}</label>

                            <div class="col-md-6">
                                <input id="a_materno" type="text" class="form-control @error('a_materno') is-invalid @enderror" name="a_materno" value="{{ old('a_materno') }}" required autocomplete="a_materno" autofocus>

                                @error('a_materno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="num_empleado" class="col-md-4 col-form-label text-md-end">{{ __('NUMERO DE EMPLEADO') }}</label>

                            <div class="col-md-6">
                                <input id="num_empleado" type="text" class="form-control @error('num_empleado') is-invalid @enderror" name="num_empleado" value="{{ old('num_empleado') }}" required autocomplete="num_empleado" autofocus>

                                @if ($errors->has('num_empleado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ 'El usuario ya existe' }}</strong>
                                    </span>
                                @endif
                         </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('TELEFONO') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cargo" class="col-md-4 col-form-label text-md-end">{{ __('CARGO') }}</label>

                            <div class="col-md-6">
                                <input id="cargo" type="text" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ old('cargo') }}" required autocomplete="cargo" autofocus>

                                @error('cargo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="campus" class="col-md-4 col-form-label text-md-end">{{ __('CAMPUS') }}</label>

                            <div class="col-md-6">
                                <input id="campus" type="text" class="form-control @error('campus') is-invalid @enderror" name="campus" value="{{ old('campus') }}" required autocomplete="campus" autofocus>

                                @error('campus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('EMAIL') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('CONTRASEÑA') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('CONFIRMAR CONTRASEÑA') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                            <!-- Agrega campos del usuario (nombre, a_paterno, etc.) aquí -->

                            <div class="form-group">
                                <label for="role">ROL</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($role as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="btn-crear-usuario">
                                        {{ __('CREAR USUARIO') }}
                                    </button>
                                </div>
                            </div>
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
    const btnCrearUsuario = document.getElementById('btn-crear-usuario');
    
    btnCrearUsuario.addEventListener('click', function(event) {
        event.preventDefault(); // Evita la presentación predeterminada del formulario
        
        if (confirm('¿Estás seguro  de registrar este usuario ?')) {
            // Si el usuario confirma, presenta el formulario
            const crearUsuarioForm = document.getElementById('crear-usuario-form');
            crearUsuarioForm.submit();
        } else {
            // Si el usuario cancela, redirige a la ruta deseada
            window.location.href = '{{ route('usuarios.principal') }}';
        }
    });
});

</script>
@stop