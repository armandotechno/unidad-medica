@extends('layouts.app')
@section('title', 'Login')
@section('content')
@section('stylesheets')
    @parent
@endsection
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 row">
    <div class="text-center">
        <h4 style="color: white; font-weight: bold; font-size: 40px; margin: 20px 0;">{{ ENV('APP_NAME') }}</h4>
    </div>
    <div class="card" style="overflow-x: hidden;">
        <div class="card-body" style="width: 500px;">
            <form class="form-center" method="POST" action="">
                @csrf
                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" id="username" name="username" required=""
                            placeholder="usuario">
                        <span class="help-block text-muted"><small>Usuario del correo institucional</small></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" id="password" name="password" required=""
                            placeholder="contraseña">
                        <span class="help-block text-muted"><small>Contraseña del correo institucional</small></span>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="button" id="btnIngresar" onclick="validarLogin()"
                            class="btn btn-lg btn-block waves-effect waves-light btn-outline-info text-uppercase">Ingresar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
