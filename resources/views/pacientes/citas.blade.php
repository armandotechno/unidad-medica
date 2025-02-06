@extends('layouts.sidebar')
@section('title', 'Citas')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection
@section('body')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Buscador de Citas</h3>
        </div>
    </div>

    <div class="row justify-content-center" style="margin-top: 40px">
        <div class="col-12 col-md-6 text-center">
            <h4 class="card-title">Buscar cita por DNI</h4>
            <form id="formBuscarDNI" method="GET" action="" class="centered-form">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" id="dni" name="dni"
                        placeholder="DNI del paciente"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        maxlength="8" required>
                </div>
                <button type="button" onclick="buscarCita()" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

<script>

    const buscarCita = () => {

        const dni = document.getElementById('dni').value;

        if ( dni.length === 0 || dni.length < 8 ) {
            Swal.fire("Aviso!", "Debes de colocar un DNI válido para buscar una cita.", "warning")
        } else {
            $.ajax({
                type: 'GET',
                url: "{{ url('buscarCitas') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {dni},
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire("Alerta", response.message, "warning");
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error", "Ocurrió un error al buscar la cita", "error");
                }
            })
        }

    }

</script>

