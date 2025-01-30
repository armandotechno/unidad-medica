@extends('layouts.sidebar')
@section('title', 'Pacientes')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 style="text-align: center; font-weight: bold; font-size: 40px">Pacientes</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/registrarPacientes') }}" class="btn btn-primary"
                    style="background-color: #040404; margin-bottom: 20px;">Nuevo Registro</a>
            </div>
        </div>
        <h4 class="card-title" style="text-align: left">Reporte de Acuerdos Creados</h4>
        <div class="table-responsive m-t-40">
            <table id="pacientes" class="display nowrap table table-hover table-striped table-bordered">
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
@section('javascripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake/vfs_fonts.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#pacientes').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print', 'colvis'
                ],
                lengthMenu: [
                    [50, 100, 500, -1],
                    [50, 100, 500, "Todos"]
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    // ... otros textos de traducción ...
                }
            });
        });
    </script>
@endsection
