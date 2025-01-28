@extends('layouts.app')
@section('title', 'Login')
@section('content')
@section('stylesheets')
    @parent
<style>
    /* Cambia el color de fondo del input */
    .form-control {
        background-color: #ADD8E6; /* Azul claro */
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
                    <img src="{{ asset('images/background/usuario.png')}}" alt="imagen-login" style="width: 120px; height: 90px;">
                </div>
                <div class="form-group m-t-40" style="border: 1px solid;">
                    <div class="col-xs-12" style="background-color: #E4E6E9; height: 65px;">
                        <span class="help-block text-muted" style="margin-left: 10px"><small style="font-weight: bold; color: #474646">Usuario</small></span>
                        <input class="form-control" type="text" id="username" name="username" required=""
                            placeholder="" style="width: 75%; height: 30px; margin-left: 10px;">
                    </div>
                </div>
                <div class="form-group" style="border: 1px solid">
                    <div class="col-xs-12" style="background-color: #E4E6E9; height: 65px;">
                        <span class="help-block text-muted" style="margin-left: 10px"><small style="font-weight: bold; color: #474646">Contraseña</small></span>
                        <input class="form-control" type="password" id="password" name="password" required=""
                            placeholder="" style="width: 75%; height: 30px; margin-left: 10px">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="button" id="btnIngresar" onclick="validarLogin()"
                            class="btn btn-lg btn-block waves-effect waves-light btn-outline-info"
                            style="border-radius: 20px; background-color: #0d47a1; color: white; width: 150px; margin: auto;"
                        >
                            Ingresar
                        </button>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col-xs-12">
                        <a href="#"><small style="font-weight: bold; color: #474646">¿Olvidaste la contraseña?</small></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
