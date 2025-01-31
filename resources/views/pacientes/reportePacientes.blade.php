@extends('layouts.sidebar')
@section('title', 'Reportes')
@section('stylesheets')
    @parent
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Reportes</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-group">
                <label for="tipo_reporte">Tipo de Reporte</label>
                <select class="form-select" name="tipo_reporte" id="tipo_reporte" required>
                    <option value="">Seleccionar tipo de reporte</option>
                    <option value="total_atenciones">Total de atenciones</option>
                    <option value="consultas_por_mes">Consultas por mes</option>
                    <option value="consultas_por_medico">Consultas por médico</option>
                    <option value="pacientes_por_servicio">Pacientes atendidos por tipo de servicio</option>
                    <option value="consultas_pendientes">Consultas pendientes o reprogramadas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="XXX......"></textarea>
            </div>

            <div class="form-group text-center">
                <button onclick="" type="button" class="btn btn-primary">
                    GENERAR REPORTE
                </button>
            </div>

            <div class="form-group text-center">
                <a href="{{ '/inicio' }}"
                    style="color: #040404; font-size: 24px; font-weight: bold;text-decoration: none; border-bottom: 2px solid black;">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>

@endsection
