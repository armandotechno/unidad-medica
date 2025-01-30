@extends('layouts.sidebar')
@section('title', 'Registrar Pacientes')
@section('stylesheets')
    @parent
    <style>
        .form-control {
            border-radius: 20px;
            background-color: #ededf4;
            padding: 10px 15px;
            height: 50px;
        }
        .btn-primary {
            border-radius: 0;
            padding: 10px 30px;
            background-color: #040404; /* Color de fondo del botón */
            border: none; /* Elimina el borde predeterminado */
            outline: none; /* Elimina el borde azul al hacer clic */
        }
        .btn-primary:focus {
            outline: none; /* Elimina el borde azul al enfocar */
            box-shadow: none; /* Elimina la sombra al enfocar */
        }
        .centered-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group {
            width: 300px;
            text-align: center;
        }
        .form-group textarea {
            width: 240px;
            border-radius: 0;
            border: 1px solid #0e0d0d;
        }
    </style>
@endsection
@section('body')

<div class="row page-titles">
    <div class="col-12 align-self-center">
        <h3 style="text-align: center; font-weight: bold; font-size: 40px">Registrar Pacientes</h3>
    </div>
</div>

<div class="container centered-form" style="margin-top: 20px;">
    <form action="" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" maxlength="32" required>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" required>
        </div>

        <div class="form-group">
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" max="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <select class="form-control" style="height: 50px" name="genero" id="genero" required>
                <option value="">Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="nro_historia" name="nro_historia" placeholder="N° Historia clínica" required>
        </div>

        <div class="form-group">
            <select class="form-control" style="height: 50px" name="tipo_sangre" id="tipo_sangre" required>
                <option value="">Tipo de sangre</option>
                @foreach ($tiposDeSangre as $tipoDeSangre)
                    <option value="{{ $tipoDeSangre->id }}">{{ $tipoDeSangre->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label style="margin-right: 200px" for="observaciones">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="2" placeholder="XXX......"></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" style="background-color: #040404;">Registrar</button>
        </div>
    </form>
</div>

@endsection
