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

            <!-- DNI y Nombre primero -->
            <div class="form-row">
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                        value="{{ session('cita')[0]->dni }}" disabled>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                    value="{{ session('cita')[0]->nombre_completo }}" disabled>
                </div>
            </div>

            <!-- Resto de los campos -->
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha">Fecha y Hora</label>
                    <input type="text" class="form-control" id="fecha" name="fecha"
                        value="{{ \Carbon\Carbon::parse(session('cita')[0]->fecha_solicitud)->format('d-m-Y') . ' ' . session('cita')[0]->hora_cita }}" disabled>
                </div>

                <div class="form-group">
                    <label for="genero">Género</label>
                    <input type="text" class="form-control" id="genero" name="genero" placeholder="Genero"
                        value="{{ session('cita')[0]->genero == 'F' ? 'Femenino' : 'Masculino' }}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="numero_consulta">Número de consulta</label>
                    <input type="text" class="form-control" id="numero_consulta" name="numero_consulta"
                        placeholder="Número de consulta" maxlength="8" required>
                </div>

                <div class="form-group">
                    <label for="motivo_consulta">Motivo de consulta</label>
                    <input type="text" class="form-control" id="motivo_consulta" name="motivo_consulta"
                        placeholder="Motivo de consulta" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="numero_historia">N° Historia clínica</label>
                    <input type="text" class="form-control" id="numero_historia" name="numero_historia"
                        placeholder="N° Historia clínica" required>
                </div>

                <div class="form-group">
                    <label for="sintomas_actuales">Síntomas actuales</label>
                    <input type="text" class="form-control" id="sintomas_actuales" name="sintomas_actuales"
                        placeholder="Sintomas actuales" value="{{ session('cita')[0]->sintomas }}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="diagnostico_principal">Diagnóstico principal</label>
                    <input type="text" class="form-control" id="diagnostico_principal" name="diagnostico_principal"
                        placeholder="Diagnóstico principal" required>
                </div>

                <div class="form-group">
                    <label for="diagnostico_adicional">Diagnóstico adicional</label>
                    <input type="text" class="form-control" id="diagnostico_adicional" name="diagnostico_adicional"
                        placeholder="Diagnóstico adicionales" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="3" required>
                </div>

                <div class="form-group">
                    <label for="plan_tratamiento">Plan de tratamiento</label>
                    <input type="text" class="form-control" id="plan_tratamiento" name="plan_tratamiento"
                        placeholder="Plan de tratamiento" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="medico">Médico</label>
                    <select class="form-select" name="medico" id="medico" required>
                        <option value="">Seleccionar médico</option>
                        @foreach ($medicos as $medico)
                            <option value="{{ $medico->id }}">{{ $medico->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                @php
                    $especialidad = \App\Models\Atencion::where('id', session('cita')[0]->especialidad_id)->first();
                @endphp

                <div class="form-group">
                    <label for="especialidad">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad" placeholder="Especialidad"
                        value="{{ $especialidad->nombre }}" disabled>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tipo_seguro">Tipo de seguro</label>
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

                <button onclick="window.location.href='/citas';" type="button" class="btn btn-primary">
                    CANCELAR CONSULTA
                </button>
            </div>
        </form>
    </div>
@endsection
