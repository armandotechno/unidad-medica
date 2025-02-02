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
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @show
</head>

<body class="fix-header fix-sidebar card-no-border">
    <aside>
        <h5 style="text-align: center; font-weight: bold;">
            <a href="{{ url('/inicio') }}" style="text-decoration: none; color: inherit;">
                POSTA MÉDICA
            </a>
        </h5>
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
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;">
                        <i class="fa-solid fa-user-plus"></i>
                    </h5>
                    <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"
                        style="font-size: 24px; line-height: 34px;">Administración</a>
                </div>
                <!-- Submenú de Administración -->
                <ul aria-expanded="false" class="collapse">
                    <li>
                        <a href="{{ url('/usuarios') }}" style="font-size: 24px; line-height: 34px;">
                            <i class="fa-solid fa-users" style="margin-right: 10px;"></i> <!-- Ícono para Usuarios -->
                            Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/doctores') }}" style="font-size: 24px; line-height: 34px;">
                            <i class="fa-solid fa-user-doctor" style="margin-right: 10px;"></i>
                            <!-- Ícono para Doctores -->
                            Doctores
                        </a>
                    </li>
                </ul>
            </li>
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
                    <a href="{{ url('/historialMedico') }}" style="font-size: 24px; line-height: 34px;">Historial
                        médico</a>
                </div>
            </li>
            <li>
                <div style="display: flex; margin-top: 10px; align-items: center; padding: 10px;">
                    <h5 style="font-size: 34px; margin-right: 20px; line-height: 34px;"><i
                            class="fa-solid fa-file-lines"></i></h5>
                    <a href="{{ '/reportePacientes' }}" style="font-size: 24px; line-height: 34px;">Informes</a>
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

<script>
    // Selecciona todos los elementos con la clase "has-arrow"
    const menuItems = document.querySelectorAll('.has-arrow');

    // Añade un evento de clic a cada elemento
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del enlace

            // Encuentra el submenú asociado
            const submenu = this.closest('li').querySelector('ul');

            // Verifica si el submenú existe
            if (submenu) {
                // Alterna la clase "collapse" para mostrar/ocultar el submenú
                if (submenu.classList.contains('collapse')) {
                    submenu.classList.remove('collapse');
                    submenu.setAttribute('aria-expanded', 'true');
                } else {
                    submenu.classList.add('collapse');
                    submenu.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
</script>
