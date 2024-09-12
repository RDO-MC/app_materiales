@extends('adminlte::page')

@section('content')
<style>
    body {
        background-color: #f7f7f7;
        color: #333;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .animated-card {
        opacity: 0;
        transform: translateY(-20px);
        animation: fadeInUp 1s ease-out forwards, moveIn 1s ease-out forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes moveIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .jumbotron {
        background: linear-gradient(45deg, #00bcd4, #4caf50);
        color: #fff;
        border-radius: 10px;
        padding: 40px;
        margin-bottom: 30px;
        text-align: center;
    }

    .card-header {
        background-color: #343a40;
        color: #ffffff;
    }

    .card-body {
        color: #555;
    }

    .contact-list li {
        margin-bottom: 10px;
    }

    .btn-custom {
        background-color: #4caf50;
        color: #fff;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #45a049;
    }
</style>

<div class="container mt-5 animated-card">
    <section id="introduccion" class="text-center">
        <div class="jumbotron">
            <h1 class="display-4">¡Bienvenido a App Web Materiales ITSZ!</h1>
            <p class="lead">Somos un equipo comprometido en proporcionar una plataforma eficiente para la gestión de materiales en el Instituto Tecnológico Superior de Zongolica.</p>
        </div>
    </section>

    <section id="objetivos" class="mt-4 animated-card">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Nuestros Objetivos</h2>
            </div>
            <div class="card-body">
                <p class="card-text">En App Web Materiales ITSZ, nos esforzamos por:</p>
                <ul>
                    <li>Optimizar la gestión de materiales en el instituto.</li>
                    <li>Facilitar la asignación y préstamo de materiales.</li>
                    <li>Proporcionar informes y reportes detallados.</li>
                    <!-- Agrega cualquier otro objetivo relevante -->
                </ul>
            </div>
        </div>
    </section>

    <section id="equipo" class="mt-4 animated-card">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Nuestro Equipo</h2>
            </div>
            <div class="card-body">
                <p class="card-text">Somos un equipo dedicado y apasionado que trabaja para mejorar continuamente la experiencia de nuestros usuarios. Conoce al equipo detrás de App Web Materiales ITSZ:</p>
                <!-- Agrega información sobre los miembros del equipo, sus roles y contribuciones -->
            </div>
        </div>
    </section>

    <section id="contacto" class="mt-4 animated-card">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Contáctanos</h2>
            </div>
            <div class="card-body">
                <p class="card-text">Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto con nosotros.</p>
                <ul class="contact-list">
                    <li><strong>Ing. Osbaldo Citlahua Hernandez</strong></li>
                    <li><strong>Correo Electrónico:</strong> <a href="mailto:atlanca2000@gmail.com">atlanca2000@gmail.com</a></li>
                    <li><strong>Teléfono:</strong> <a href="tel:+522781203455">+52 278-120-34-55</a></li>
                    <li><strong>Ing. Rivaldo David Xochicale Cueyactle</strong></li>
                    <li><strong>Correo Electrónico:</strong> <a href="mailto:acdcdestruc@gmail.com">acdcdestruc@gmail.com</a></li>
                    <li><strong>Teléfono:</strong> <a href="tel:+522721873491">+52 272-187-34-91</a></li>
                    <!-- Agrega cualquier otro medio de contacto que desees proporcionar -->
                </ul>
            </div>
        </div>
    </section>
</div>
@endsection
