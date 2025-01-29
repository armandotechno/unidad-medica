@extends('layouts.sidebar')
@section('title', 'Registrar Pacientes')
@section('stylesheets')
    @parent
@endsection
@section('body')

<div class="row page-titles">
    <div class="col-12 align-self-center">
        <h3 style="text-align: center; font-weight: bold; font-size: 40px">Registrar Pacientes</h3>
    </div>
</div>

<div class="container">
    <form action="" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>

        <div class="form-group">
            <label for="genero">Género</label>
            <select class="form-control" name="genero" id="genero" required>
                <option value="">Seleccione</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nro_historia">N° Historia clínica</label>
            <input type="text" class="form-control" id="nro_historia" name="nro_historia" required>
        </div>

        <div class="form-group">
            <label for="tipo_sangre">Tipo de Sangre</label>
            <select class="form-control" name="tipo_sangre" id="tipo_sangre" required>
                <option value="">Seleccione</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>

        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <input type="text" class="form-control" id="observaciones" name="observaciones">
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </form>
</div>

@endsection
