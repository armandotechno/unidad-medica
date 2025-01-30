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
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
        <style>
            body {
                display: flex;
                margin: 0;
                height: 100vh;
                /* Asegúrate de que el body ocupe toda la altura de la ventana */
            }

            aside {
                background-color: #1b2742;
                color: white;
                width: 350px;
                padding: 20px;
                height: 100%;
                /* Asegúrate de que el sidebar ocupe toda la altura */
                overflow-y: auto;
                /* Permite el desplazamiento si el contenido es más alto que la ventana */
            }

            .content {
                flex: 1;
                /* Ocupa el resto del espacio disponible */
                padding: 20px;
                background-color: #f8f9fa;
                overflow-y: auto;
                /* Permite el desplazamiento si el contenido es más alto que la ventana */
            }

            aside h4 {
                margin-bottom: 20px;
                /* Espaciado inferior para el título */
            }

            aside ul {
                list-style-type: none;
                /* Sin viñetas */
                padding: 0;
                /* Sin padding */
            }

            aside ul li {
                margin: 10px 0;
                /* Espaciado entre los elementos de la lista */
            }

            aside ul li a {
                color: white;
                /* Color de los enlaces */
                text-decoration: none;
                /* Sin subrayado */
            }

            aside ul li a:hover {
                text-decoration: underline;
                /* Subrayar al pasar el mouse */
            }
        </style>
    @show
</head>

<body class="fix-header fix-sidebar card-no-border">
    <aside>
        <h5 style="text-align: center; font-weight: bold">POSTA MÉDICA</h5>
        <div style="display: flex; margin-top: 70px; align-items: center; padding: 10px;">
            <h5 style="margin-right: 20px;">
                <i class="fa-solid fa-circle-user" style="font-size: 64px;"></i>
            </h5>
            <h5 style="font-weight: bold">{{ Auth::user()->nombre_completo }}</h5>
        </div>
        <h5 style="">Menú</h5>
        <ul>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;"><i
                            class="fa-solid fa-users"></i></h5>
                    <a href="{{ url('/inicio') }}" style="font-size: 24px; line-height: 34px;">Panel</a>
                </div>
            </li>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;"><i
                            class="fa-solid fa-clipboard-list"></i></h5>
                    <a href="{{ url('/pacientes') }}" style="font-size: 24px; line-height: 34px;">Gestión de
                        pacientes</a>
                </div>
            </li>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;"><i
                            class="fa-solid fa-book-medical"></i></h5>
                    <a href="#" style="font-size: 24px; line-height: 34px;">Historial médico</a>
                </div>
            </li>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;"><i
                            class="fa-solid fa-file-lines"></i></h5>
                    <a href="#" style="font-size: 24px; line-height: 34px;">Informes</a>
                </div>
            </li>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <a href="#" style="font-size: 34px; margin-top: 20px; line-height: 34px;"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </aside>

    <div class="content">
        @yield('body')
    </div>

    @yield('javascripts')
</body>

</html>
