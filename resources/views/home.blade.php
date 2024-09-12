@extends('adminlte::page')

@section('content')
<style>
    body {
        background-color: #f7f7f7;
    }

    .welcome-card {
        background-color: #ffffff;
        border: 1px solid #e1e1e1;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: 50px;
        opacity: 0;
        animation: fadeIn 1s ease-out forwards, moveIn 1s ease-out forwards;
    }

    .card-header {
        background-color: #007BFF;
        color: #ffffff;
        padding: 20px;
        border-bottom: 2px solid #0056b3;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 30px;
        text-align: center;
    }

    .btn-custom {
        margin-top: 20px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .greeting {
        font-size: 36px;
        font-weight: bold;
        color: #007BFF;
        margin-bottom: 10px;
        opacity: 0;
        animation: fadeIn 1s ease-out forwards, moveIn 1s ease-out forwards;
    }

    .welcome-text {
        font-size: 18px;
        color: #555;
        margin-bottom: 30px;
        opacity: 0;
        animation: fadeIn 1s ease-out forwards, moveIn 1s ease-out forwards;
    }

    .highlight-text {
        font-size: 24px;
        color: purple;
        font-weight: bold;
    }

    /* Fondo gradiente */
    .gradient-background {
        background: linear-gradient(45deg, #0056b3, #007BFF);
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    /* Animación de movimiento */
    @keyframes moveIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Botones con animación de hover */
    .btn-custom {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        color: #fff;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="welcome-card">
                <div class="card-header gradient-background">
                    <h2 style="margin-bottom: 0; color: #fff;"> <span class="highlight-text">App Web Materiales ITSZ</span></h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @guest
                        <p class="font-size-lg text-primary">¡Hola Invitado!</p>
                        <p class="welcome-text">Explora nuestra plataforma para gestionar materiales de manera eficiente en el Instituto Tecnológico Superior de Zongolica.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-custom">Registrarse</a>
                        <a href="{{ route('login') }}" class="btn btn-success btn-custom">Iniciar Sesión</a>
                    @else
                        <p class="font-size-lg text-success greeting">
                           ¡Bienvenido, {{ Auth::user()->nombre }}!
                        </p>
                        <p class="welcome-text">Encuentra y gestiona fácilmente los materiales disponibles. ¡Comienza a utilizar todas las funciones ahora mismo!</p>
                        
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
