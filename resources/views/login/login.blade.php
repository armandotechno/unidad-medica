@extends('layouts.app')
@section('title', 'Login')
@section('content')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    @parent

    <style>
        /* Cambia el color de fondo del input */
        .form-control {
            background-color: #cce4fc;
            border-radius: 0;
            border: none;
        }
    </style>
@endsection
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 row">
    <div class="card" style="overflow-x: hidden; width: 300px;height: 500px;">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <form class="form-center" method="POST" action="">
                @csrf
                <div class="form-group m-t-40" style="text-align: center;">
                    <div>
                        <h4 style="font-weight: bolder; color: #474646">Iniciar Sesión</h4>
                    </div>
                    <img src="{{ asset('images/background/usuario.png') }}" alt="imagen-login"
                        style="width: 120px; height: 90px;">
                </div>
                <div class="form-group m-t-40" style="border: 1px solid;">
                    <div class="col-xs-12" style="background-color: #E4E6E9; height: 65px;">
                        <span class="help-block text-muted" style="margin-left: 10px"><small
                                style="font-weight: bold; color: #474646">Usuario</small></span>
                        <input class="form-control" type="text" id="correo" name="correo" required=""
                            placeholder="" style="width: 75%; height: 30px; margin-left: 10px;">
                    </div>
                </div>
                <div class="form-group" style="border: 1px solid">
                    <div class="col-xs-12" style="background-color: #E4E6E9; height: 65px;">
                        <span class="help-block text-muted" style="margin-left: 10px"><small
                                style="font-weight: bold; color: #474646">Contraseña</small></span>
                        <input class="form-control" type="password" id="password" name="password" required=""
                            placeholder="" style="width: 75%; height: 30px; margin-left: 10px">
                        <button type="button" onclick="mostrarPassword()"
                            style="position: absolute; right: 85px; top: 295px; background: none; border: none; cursor: pointer;">
                            <span id="eyeIcon"><i class="fa-regular fa-eye"></i></span>
                        </button>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="button" id="btnIngresar" onclick="validarLogin()"
                            class="btn btn-outline-info"
                            style="border-radius: 20px; background-color: #2c64c6; color: white; width: 150px; margin: auto; padding: 5px 10px; height: 35px;">
                            Ingresar
                        </button>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12">
                        <a href="#"><small style="font-weight: bold; color: #474646">¿Olvidaste la
                                contraseña?</small></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
<script>
$(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

const validarLogin = () => {

    let correo = $("#correo").val();
    let clave = $("#password").val();

    $.ajax({
        type: 'POST',
        url: "{{ url('validarLogin') }}",
        data: {
            correo,
            clave
        },
        success: function(data) {
            if ( data == 1 ) {
                location.href = '/inicio';
            } else if ( data == 2 ) {
                swal("Alerta", "El usuario no existe en la base de datos.", "warning")
            } else {
                alert('acá')
            }
        }
    })
}
</script>

