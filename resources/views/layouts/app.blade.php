<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('icono.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body{
            background-color: #f7f7f7;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="d-flex flex-column justify-content-between" style="height: 100vh !important;">
        @include('navbar')
        <main>
            @yield('content')
        </main>
        <footer class="shadow mt-5">
            <div class="text-center py-4 bg-white d-flex justify-content-around align-items-center px-5">
                <p class="mb-0">X RAY MED S.R.L. - Tesis de grado para la UAJMS</p>
                <img src="{{ asset('escudo.png') }}" alt="escudo" width="60px">
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
