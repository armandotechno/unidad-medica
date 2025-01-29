@extends('layouts.sidebar')
@section('title', 'Pacientes')
@section('stylesheets')
    @parent
@endsection
@section('body')

<div class="row page-titles">
    <div class="col-12 align-self-center">
        <h3 style="text-align: center; font-weight: bold; font-size: 40px">Pacientes</h3>
    </div>
</div>

<a href="{{ url('/registrarPacientes') }}" class="btn btn-primary" style="background-color: #040404">Nuevo Registro</a>

<div class="container">
    <h4 class="card-title" style="text-align: left">Reporte de Acuerdos Creados</h4>
    <div class="table-responsive m-t-40">
            <table id="reporteVisas" class="display nowrap table table-hover table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>N°Historia Clinica</th>
                        <th>Tipo de seguro</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: left;">
                        <td>1</td>
                        <td>Prueba</td>
                        <td>Masculino</td>
                        <td>101</td>
                        <td>Miranda</td>
                    </tr>
                </tbody>
            </table>
    </div>

</div>

@endsection
