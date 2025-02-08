@extends('layouts.sidebar')
@section('title', 'Reportes')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
    <style>
        .btn-primary {
            background-color: #040404;
            border: none;
            outline: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .dataTables_filter {
            display: flex;
            align-items: center;
        }

        .dataTables_filter label {
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .dataTables_filter input {
            margin-left: 10px;
            flex: 1;
        }

        .dataTables_length select {
            color: #000000;
            /* Color del texto */
            background-color: #ffffff;
            /* Color de fondo */
            border: 1px solid #cccccc;
            /* Borde */
            border-radius: 4px;
            /* Bordes redondeados */
            padding: 5px;
            /* Espaciado interno */
        }

        /* Estilos para las opciones del menú desplegable */
        .dataTables_length select option {
            color: #000000;
            /* Color del texto */
            background-color: #ffffff;
            /* Color de fondo */
        }

        /* Estilos para el texto del label del menú desplegable */
        .dataTables_length label {
            color: #000000;
            /* Color del texto */
        }

        /* Agregar líneas negras debajo de cada fila */
        #consultasTable tbody tr {
            border-bottom: 2px solid #000000 !important;
            /* Línea negra debajo de cada fila */
        }

        /* Aumentar la especificidad para las celdas */
        #consultasTable tbody td {
            padding: 10px !important;
            /* Ajusta el padding según sea necesario */
        }

        /* Aumentar la especificidad para la tabla */
        #consultasTable {
            border-collapse: collapse !important;
            /* Fusiona los bordes de las celdas */
            width: 100% !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;

        }

        /* Aumentar la especificidad para el encabezado */
        #consultasTable thead th {
            border-bottom: 2px solid #000000 !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            /* Línea negra debajo del encabezado */
        }

        #consultasTable tbody tr td {
            border-bottom: 2px solid #000000 !important;
            /* Línea negra debajo de cada celda */
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #040404;
            border: none;
        }

        .page-item .page-link {
            z-index: 1;
            color: #040404;
            background-color: #fff;
            border: none;
        }
    </style>
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
                <select class="form-select" name="tipo_reporte" id="tipo_reporte" style="width: 500px" required>
                    <option value="">Seleccionar tipo de reporte</option>
                    <option value="total_atenciones">Total de atenciones</option>
                    <option value="consultas_por_mes">Consultas por mes</option>
                    <option value="consultas_por_medico">Consultas por médico</option>
                    <option value="pacientes_por_servicio">Pacientes atendidos por tipo de servicio</option>
                    <option value="consultas_pendientes">Consultas pendientes o reprogramadas</option>
                </select>
            </div>

            <div class="form-group" id="fecha_inicio_group" style="display: none">
                <label for="fecha_inicio">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
            </div>

            <div class="form-group" id="fecha_fin_group" style="display: none">
                <label for="fecha_fin">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
            </div>

            <div class="form-group" id="mesGroup" style="display: none;">
                <label for="mes">Mes</label>
                <select class="form-select" name="mes" id="mes" style="width: 500px">
                    <option value="">Seleccionar mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>

            <div class="form-group" id="anioGroup" style="display: none;">
                <label for="anio">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" min="2024" max="2100"
                    value="{{ date('Y') }}">
            </div>

            <div class="form-group" id="tipo_servicio" style="display: none">
                <label for="servicio_id">Tipo de servicio</label>
                <select class="form-select" name="servicio_id" id="servicio_id" style="width: 500px">
                    <option value="">Seleccionar tipo de servicio</option>
                    <option value="1">Particular</option>
                    <option value="2">CIS</option>
                </select>
            </div>

            <div class="form-group" id="medico_group" style="display: none">
                <label for="medico_id">Médico</label>
                <select class="form-select" name="medico_id" id="medico_id" style="width: 500px">
                    <option value="">Seleccionar médico</option>
                    @foreach ($medicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" style="display: none">
                <label for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="XXX......"></textarea>
            </div>

            <div class="form-group text-center">
                <button type="button" class="btn btn-primary" id="generar_reporte_btn">
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


    <div class="container" id="tablaConsultas" style="display: none;">
        <div class="table-responsive m-t-40">
            <table id="consultasTable" class="display nowrap table table-hover table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Motivo</th>
                        <th>Diagnóstico</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas se llenarán dinámicamente con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/reportes.js') }}"></script>

@endsection
