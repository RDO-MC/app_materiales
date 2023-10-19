@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">

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
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar Usuario') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal de confirmación -->
     <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas guardar los cambios?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
@endsection
