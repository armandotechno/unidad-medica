<div class="row page-titles">
    <div class="col-12 align-self-center">
        <h3>Detalles de la Consulta</h3>
    </div>
</div>

@php
    $paciente = \App\Models\Paciente::where('id', $consulta->paciente_id)->first();
    $medico = \App\Models\Medico::where('id', $consulta->medico_id)->first();
    $especialidad = \App\Models\Atencion::where('id', $consulta->especialidad_id)->first();

    $fecha_nacimiento = new DateTime($paciente->fecha_nac);
    $fecha_actual = new DateTime();
    $diferencia = $fecha_actual->diff($fecha_nacimiento);
    $edad = $diferencia->y;

@endphp

<div class="row">
    <div class="col-md-6">
        <p><strong>DNI:</strong> {{ $paciente->dni }}</p>
        <p><strong>Nombre:</strong> {{ $paciente->nombre_completo }}</p>
        <p><strong>Fecha y Hora:</strong> {{ $consulta->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Género:</strong> {{ $paciente->genero == 'M' ? 'Masculino' : 'Femenino' }}</p>
        <p><strong>Número de Consulta:</strong> {{ $consulta->nroconsulta }}</p>
        <p><strong>Motivo:</strong> {{ $consulta->motivo }}</p>
        <p><strong>N° Historia clínica:</strong> {{ $consulta->nrohistoria }}</p>
    </div>
    <div class="col-md-6">
        <p><strong>Síntomas:</strong> {{ $consulta->sintomas }}</p>
        <p><strong>Diagnóstico Principal:</strong> {{ $consulta->diagnosticoprin }}</p>
        <p><strong>Diagnóstico Secundario:</strong> {{ $consulta->diagnosticoadi }}</p>
        <p><strong>Edad:</strong> {{ $edad }}</p>
        <p><strong>Plan de Tratamiento:</strong> {{ $consulta->plantratamiento }}</p>
        <p><strong>Médico:</strong> {{ $medico->nombre }}</p>
        <p><strong>Tipo de Seguro:</strong> {{ $consulta->tiposeguro == '1' ? 'Particular' : 'CIS' }}</p>
    </div>
</div>
