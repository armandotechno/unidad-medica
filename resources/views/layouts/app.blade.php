<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ministerio del Poder Popular para Relaciones Exteriores">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('title') </title>
    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    @show
    <style>
        body {
            background: rgb(6, 16, 101) no-repeat;
            background: -moz-linear-gradient(180deg, rgba(6, 16, 101, 1) 0%, rgba(255, 255, 255, 1) 80%) no-repeat;
            background: -webkit-linear-gradient(180deg, rgba(6, 16, 101, 1) 0%, rgba(255, 255, 255, 1) 80%) no-repeat;
            background: linear-gradient(180deg, rgba(6, 16, 101, 1) 0%, rgba(255, 255, 255, 1) 80%) no-repeat;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#061065", endColorstr="#ffffff", GradientType=1);
        }
    </style>
    <style>
        .d-flex {
            height: 100vh;
            /* Asegúrate de que el contenedor ocupe toda la altura de la ventana */
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
