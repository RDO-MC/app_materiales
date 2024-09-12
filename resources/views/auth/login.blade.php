@extends('layouts.app')

@section('content')
    <div class="background-image" id="backgroundImage">
        <img src="{{ asset('uploads/itsz/fondo.jpeg') }}" alt="Background Image 1">
    </div>
    <div class="login-content" style="background-color: rgba(139, 0, 139, 0.5); color: white; text-align: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="container">
                    <div class="container">
                        <h4>{{ __('INICIAR SESIÓN') }}</h4>
                    </div>
                    <div class="container">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 row">
                                <label for="email" class="container">{{ __('CORREO:') }}</label>
                                <div class="container">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="container">{{ __('CONTRASEÑA:') }}</label>
                                <div class="container">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="container">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('INICIAR SESIÓN') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .background-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(100%) blur(-10px); /* Ajusta el brillo aquí */
        }

        .login-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            box-shadow: none;
        }

        .card-body {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
        }
    </style>

    <style>
        .background-image img {
            transition: opacity 0.01s ease-in-out;
        }
    
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const backgroundImages = [
            'fondo.jpg',
            'fondo2.jpg',
            'fondo4.jpg',
            'fondo5.jpg',  // Agrega más nombres de archivos de imagen según sea necesario
        ];

        const backgroundImage = document.getElementById('backgroundImage');

        const initialIndex = Math.floor(Math.random() * backgroundImages.length);
        let currentIndex = initialIndex;

        function changeBackgroundImage() {
            currentIndex = (currentIndex + 1) % backgroundImages.length;
            const newImageUrl = '{{ asset('uploads/itsz/') }}/' + backgroundImages[currentIndex];
            const newImage = new Image();
            newImage.src = newImageUrl;

            // Agregar la nueva imagen con opacidad cero
            newImage.style.opacity = '0';
            backgroundImage.innerHTML = '';
            backgroundImage.appendChild(newImage);

            // Aplicar la transición y aumentar la opacidad
            setTimeout(() => {
                newImage.style.opacity = '1';
            }, 10);
        }

        changeBackgroundImage();

        function setCookie(name, value) {
            document.cookie = `${name}=${value}`;
        }

        setCookie('lastImageIndex', currentIndex);

        setInterval(changeBackgroundImage, 10000);
    });
</script>

@endsection
