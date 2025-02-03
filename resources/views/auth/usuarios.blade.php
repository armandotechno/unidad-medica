@extends('layouts.sidebar')
@section('title', 'Usuarios')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
    <style>
        .btn-primary {
            background-color: #040404;
            border: none;
            outline: none;
        }

        .table-responsive {
            overflow-x: hidden; /* Permite el desplazamiento horizontal */
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

        /* Agregar líneas negras debajo de cada fila */
        #usuarios tbody tr {
            border-bottom: 2px solid #000000 !important;
            /* Línea negra debajo de cada fila */
        }

        /* Aumentar la especificidad para las celdas */
        #usuarios tbody td {
            padding: 10px !important;
            /* Ajusta el padding según sea necesario */
        }

        /* Aumentar la especificidad para la tabla */
        #usuarios {
            border-collapse: collapse !important;
            /* Fusiona los bordes de las celdas */
            width: 100% !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;

        }

        /* Aumentar la especificidad para el encabezado */
        #usuarios thead th {
            border-bottom: 2px solid #000000 !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            /* Línea negra debajo del encabezado */
        }

        #usuarios tbody tr td {
            border-bottom: 2px solid #000000 !important; /* Línea negra debajo de cada celda */
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
            <h3 style="text-align: center; font-weight: bold; font-size: 40px">Usuarios</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/nuevoUsuario') }}" class="btn btn-primary"
                    style="background-color: #040404; margin-bottom: 20px;">Nuevo Usuario</a>
            </div>
        </div>
        <div class="table-responsive m-t-40">
            <table id="usuarios" class="display nowrap table table-hover table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr style="text-align: center;">
                            <td>{{ $usuario->nombre_completo }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td style="text-align: center; padding: 5px">
                                <button style="border: none; background: none; padding: 0;"
                                    onclick="editarUsuario({{ $usuario->id }})" data-toggle="tooltip" data-placement="top"
                                    title="Editar Usuario">
                                    <i class="fa-solid fa-pen-to-square"
                                        style="color: rgb(33, 172, 33); font-size: 25px"></i>
                                </button>
                                <button style="border: none; background: none; padding: 0;"
                                    onclick="eliminarUsuario({{ $usuario->id }})" data-toggle="tooltip"
                                    data-placement="top" title="Eliminar Usuario">
                                    <i class="fa-regular fa-trash-can" style="color: red; font-size: 25px; "></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body" id="m-content">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect text-left"
                            data-dismiss="modal">Cerrar</button>
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

        $(document).ready(function() {
            var table = $('#usuarios').DataTable({
                dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rtip',
                buttons: [
                    // Aquí puedes agregar botones si los necesitas
                ],
                lengthMenu: [
                    [10, 20, 30, -1],
                    [10, 20, 30, "Todos"]
                ],
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
                    $('.dataTables_filter label').html('Nombre: <i class="fas fa-search"></i>').append(
                        searchInput);

                    // Asegurar que el input de búsqueda siga funcionando
                    searchInput.on('keyup', function() {
                        table.search(this.value).draw();
                    });
                }
            });
        });

        $('#myModal').on('hidden.bs.modal', function() {
            location.reload(); // Recarga la página cuando el modal se cierra
        });

        function editarUsuario(id) {

            let usuario_id = id

            $.ajax({
                type: 'POST',
                url: "{{ url('editarUsuario') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    usuario_id
                },
                success: function(data) {
                    $("#myModal").modal();
                    $("#myModal").modal("toggle");
                    $("#m-content").html(data);
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error", "Ocurrió un error en la solicitud: " + error, "error");
                }
            });
        }

        function eliminarUsuario(id) {

            let usuario_id = id

            swal({
                title: 'Confirmación',
                text: "¿Está seguro de eliminar a este usuario?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: 'success',
                cancelButtonColor: 'danger',
                cancelButtonText: 'No',
                confirmButtonText: 'Sí'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('eliminarUsuario') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            usuario_id
                        },
                        success: function(data) {
                            if (data === 1) {
                                swal('Proceso exitoso.', "", "success")
                                    .then(function() {
                                        location.reload();
                                    });
                            } else {
                                swal("Ha ocurrido un problema.", "", "error");
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire("Error", "Ocurrió un error en la solicitud: " + error, "error");
                        }
                    });
                }
            });
        }
    </script>
@endsection
