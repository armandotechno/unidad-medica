<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Posta Médica | @yield('title')</title>
    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/colors/green-dark.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
        <style>
            body {
                display: flex; /* Usar flexbox para alinear el sidebar y el contenido */
                margin: 0; /* Eliminar márgenes */
                height: 100vh; /* Altura completa de la ventana */
            }
            aside {
                background-color: #1b2742; /* Azul oscuro */
                color: white; /* Color del texto */
                width: 250px; /* Ancho fijo para el sidebar */
                padding: 20px; /* Espaciado interno */
                height: 100%; /* Altura completa */
            }
            .content {
                flex: 1; /* Ocupa el resto del espacio disponible */
                padding: 20px; /* Espaciado interno para el contenido */
                background-color: #f8f9fa; /* Color de fondo para el contenido */
            }
            aside h4 {
                margin-bottom: 20px; /* Espaciado inferior para el título */
            }
            aside ul {
                list-style-type: none; /* Sin viñetas */
                padding: 0; /* Sin padding */
            }
            aside ul li {
                margin: 10px 0; /* Espaciado entre los elementos de la lista */
            }
            aside ul li a {
                color: white; /* Color de los enlaces */
                text-decoration: none; /* Sin subrayado */
            }
            aside ul li a:hover {
                text-decoration: underline; /* Subrayar al pasar el mouse */
            }
        </style>
    @show
</head>

<body class="fix-header fix-sidebar card-no-border">
    <aside>
        <h4>Menú</h4>
        <ul>
            <li><a href="#">Usuarios</a></li>
            <li><a href="#">Pacientes</a></li>
            <li><a href="#">Reportes</a></li>
        </ul>
    </aside>

    <div class="content">
        @yield('body')
    </div>
</body>

</html>
