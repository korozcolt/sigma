<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
          content="Sigma - sistema te gestion de usuarios para colombia y planilla de coordinadores y lideres para acceso a informacion rapida y automatizada  de lugares y puestos de votacion" />
    <meta name="keywords"
          content="votantes, puestos, votaciones, colombia, info, registraduria, coordinadores, coordinador, votos, líderes" />
    <meta name="author" content="Kronnos" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- Facebook --}}
    <meta property="og:title" content="SIGMA APP">
    <meta property="og:description"
          content="Sigma - sistema te gestion de usuarios para colombia y planilla de coordinadores y lideres para acceso a informacion rapida y automatizada  de lugares y puestos de votacion">
    <meta property="og:url" content="http://sigmaapp.co/">
    <meta property="og:image" content="{{ asset('android-icon-72x72.png') }}">
    {{-- Twitter --}}
    <meta name="twitter:title" content="SIGMA APP">
    <meta name="twitter:description"
          content="Sigma - sistema te gestion de usuarios para colombia y planilla de coordinadores y lideres para acceso a informacion rapida y automatizada  de lugares y puestos de votacion">
    <meta name="twitter:url" content="http://sigmaapp.co/">
    <meta name="twitter:card" content="{{ asset('/apple-icon-114x114.png') }}">
    <meta name="twitter:image" content="{{ asset('android-icon-72x72.png') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>SIGMA APP</title>
    @vite(['resources/css/home.scss'])
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>


</body>

</html>
