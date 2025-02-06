@extends('layouts.sidebar')
@section('title', 'Consultas Previas')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
            <h3>Buscador de Consultas</h3>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 40px">
        <div class="col-12 col-md-6 text-center">
            <h4 class="card-title">Buscar Consulta por DNI</h4>
            <form id="formBuscarDNI" method="GET" action="" class="centered-form">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI del paciente"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" required>
                </div>
                <button type="button" onclick="buscarConsulta()" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>

    <div class="container" id="tablaConsultas" style="display: none;">
        <div class="table-responsive m-t-40">
            <table id="consultasTable" class="display nowrap table table-hover table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>Número de Consulta</th>
                        <th>Motivo</th>
                        <th>Diagnóstico Principal</th>
                        <th>Plan de Tratamiento</th>
                        <th>Visualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Las filas se llenarán dinámicamente con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-12 col-lg-12">
    <div class="modal fade" id="modalVisualizarConsulta">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="modal-consulta-content">
                    <!-- Aquí se cargará el contenido de la consulta -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
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

    <script>
        Swal.setDefaults({
            backdrop: false // Desactiva el backdrop por defecto
        });

        document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evita el comportamiento por defecto del Enter
            buscarConsulta(); // Llama a la función de validación
        }
    });

        const buscarConsulta = () => {
            const dni = document.getElementById('dni').value;

            if (dni.length === 0 || dni.length < 8) {
                Swal.fire("Aviso!", "Debes de colocar un DNI válido para buscar las consultas.", "warning");
            } else {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('buscarConsultas') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        dni
                    },
                    success: function(response) {
                        if (response.success) {
                            // Mostrar la tabla
                            document.getElementById('tablaConsultas').style.display = 'block';

                            // Limpiar la tabla antes de agregar nuevos datos
                            $('#consultasTable').DataTable().clear().destroy();

                            // Inicializar DataTable con la configuración deseada
                            var table = $('#consultasTable').DataTable({
                                data: response.consultas,
                                columns: [{
                                        data: 'nroconsulta'
                                    },
                                    {
                                        data: 'motivo'
                                    },
                                    {
                                        data: 'diagnosticoprin'
                                    },
                                    {
                                        data: 'plantratamiento'
                                    },
                                    {
                                        data: 'created_at',
                                        render: function(data, type, row) {
                                            // Botón para abrir el modal
                                            return `<button class="btn btn-primary btn-sm" onclick="visualizarConsulta(${row.id})"><i class="fa-solid fa-eye"></i></button>`;
                                        }
                                    } // Ajusta esto según el campo de fecha en tu modelo
                                ],
                                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                                buttons: [
                                    // Aquí puedes agregar botones si los necesitas
                                ],
                                lengthMenu: [
                                    [10, 20, 30, -1],
                                    [10, 20, 30, "Todos"]
                                ],
                                scrollX: true, // Habilita el scroll horizontal
                                scrollY: '400px', // Habilita el scroll vertical con una altura fija
                                scrollCollapse: true, // Colapsa la tabla si los datos no llenan el espacio
                                language: {
                                    "decimal": "",
                                    "emptyTable": "Ningún dato disponible en esta tabla",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(Filtrado de un total de _MAX_ registros)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "",
                                    "zeroRecords": "No se encontraron resultados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Último",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    },
                                    "aria": {
                                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                                    }
                                },
                                initComplete: function() {
                                    // Personalizar el input de búsqueda
                                    var searchInput = $('.dataTables_filter input')
                                        .attr('placeholder', 'Buscar...')
                                        .css({
                                            'margin-left': '10px',
                                            'flex': '1'
                                        });

                                    // Agregar el ícono de lupa y el texto "Nombre:"
                                    $('.dataTables_filter label').html(
                                        'Nombre: <i class="fas fa-search"></i>').append(
                                        searchInput);

                                    // Asegurar que el input de búsqueda siga funcionando
                                    searchInput.on('keyup', function() {
                                        table.search(this.value).draw();
                                    });
                                }
                            });
                        } else {
                            Swal.fire("Alerta", response.message, "warning");
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire("Error", "Ocurrió un error al buscar las consultas", "error");
                    }
                });
            }
        };

        $(document).ready(function() {
            // Aquí puedes colocar otras inicializaciones si es necesario
        });

        function visualizarConsulta(consultaId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('visualizarConsulta') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    consulta_id: consultaId
                },
                success: function(data) {
                    // Cargar el contenido en el modal
                    $("#modal-consulta-content").html(data);
                    // Mostrar el modal
                    $("#modalVisualizarConsulta").modal("toggle");
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error", "Ocurrió un error al cargar la consulta: " + error, "error");
                }
            });
        }
    </script>
@endsection
