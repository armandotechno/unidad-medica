@extends('layouts.sidebar')
@section('title', 'Historial Médico')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection
@section('body')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Gestión de consultas médicas</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        placeholder="Fecha y hora" onfocus="(this.type='date')" max="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="genero" id="genero" required>
                        <option value="">Género</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="numero_consulta" name="numero_consulta"
                        placeholder="Número de consulta" maxlength="8" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="motivo_consulta" name="motivo_consulta"
                        placeholder="Motivo de consulta: " required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="numero_historia" name="numero_historia"
                        placeholder="N° Historia clínica" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="sintomas_actuales" name="sintomas_actuales"
                        placeholder="Sintomas actuales" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="diagnostico_principal" name="diagnostico_principal"
                        placeholder="Diagnóstico principal" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="3" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="diagnostico_adicional" name="diagnostico_adicional"
                        placeholder="Diagnóstico adicionales:" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="plan_tratamiento" name="plan_tratamiento"
                        placeholder="Plan de tratamiento" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="medico" name="medico"
                        placeholder="Médico que preescribe" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="especialidad" id="especialidad" required>
                        <option value="">Especialidad</option>
                        <option value="1">Especialidad 1</option>
                        <option value="2">Especialidad 2</option>
                        <option value="3">Especialidad 3</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="tipo_seguro" id="tipo_seguro" required>
                        <option value="">Tipo de seguro</option>
                        <option value="1">Particular</option>
                        <option value="2">CIS</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="medicamentos_recetados">MEDICAMENTOS RECETATOS:</label>
                    <textarea class="form-control" id="medicamentos_recetados" name="medicamentos_recetados" rows="2"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" placeholder="XXX......"></textarea>
                </div>
                <div class="form-group">
                    <label for="consultas_previas">CONSULTAS PREVIAS:</label>
                    <textarea class="form-control" id="consultas_previas" name="consultas_previas" rows="2"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" placeholder="XXX......"></textarea>
                </div>
            </div>

            <div class="form-group text-center">
                <button onclick="" type="button" class="btn btn-primary">
                    GUARDAR CONSULTA
                </button>

                <button onclick="" type="button" class="btn btn-primary">
                    IMPRIMIR RECETA
                </button>

                <button onclick="" type="button" class="btn btn-primary">
                    CANCELAR CONSULTA
                </button>
            </div>
        </form>
    </div>
@endsection
