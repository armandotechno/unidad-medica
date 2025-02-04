@extends('layouts.sidebar')
@section('title', 'Nuevo Doctor')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/registrarPaciente.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Nuevo Doctor</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = this.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="cmp">CMP</label>
                    <input type="text" class="form-control" id="cmp" name="cmp" placeholder="CMP"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6" required>
                </div>
            </div>

            <div class="form-group text-center">
                <button onclick="crearDoctor()" type="button" class="btn btn-primary">
                    CREAR DOCTOR
                </button>
            </div>

            <div class="form-group text-center">
                <a href="{{ '/doctores' }}"
                    style="color: #040404; font-size: 18px; font-weight: bold;text-decoration: none; border-bottom: 2px solid black;">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        Swal.setDefaults({
            backdrop: false // Desactiva el backdrop por defecto
        });

        const crearDoctor = () => {
            const nombre = document.getElementById('nombre').value;
            const dni = document.getElementById('dni').value;
            const cmp = document.getElementById('cmp').value;

            if (nombre === '' || dni === '' || cmp === '') {
                Swal.fire({
                    type: 'warning',
                    title: 'Todos los campos son obligatorios.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else if (dni.length < 8) {
                Swal.fire({
                    type: 'warning',
                    title: 'El DNI debe tener 8 dígitos.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else if (nombre.length < 6) {
                Swal.fire({
                    type: 'warning',
                    title: 'El nombre del doctor debe tener al menos 6 caracteres.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else if (cmp.length < 6) {
                Swal.fire({
                    type: 'warning',
                    title: 'El cmp debe tener al menos 6 caracteres.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else {

                let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('cmp', cmp);

                Swal.fire({
                    type: 'question',
                    title: 'Confirmación',
                    text: "¿Está seguro que quiere guardar los datos suministrados? Esta opción será irreversible",
                    showCancelButton: true,
                    confirmButtonColor: 'success',
                    cancelButtonColor: 'danger',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Sí',
                    backdrop: false
                }).then((result) => {
                    if (result.value) { // Cambiar result.value por result.isConfirmed
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('crearDoctor') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire("Éxito", "Doctor creado exitosamente.", "success")
                                        .then(
                                            () => {
                                                window.location.href = '{{ url('doctores') }}';
                                            });

                                } else if ( data == 2 ) {
                                    Swal.fire("Alerta", "El DNI ya está registrado.", "warning")
                                } else if ( data == 3 ) {
                                    Swal.fire("Alerta", "El CMP ya está registrado.", "warning")
                                } else {
                                    Swal.fire("Error", "Ocurrió un error al crear el usuario.",
                                        "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire("Error", "Ocurrió un error en la solicitud: " + error,
                                    "error");
                            }
                        });
                    }
                });
            }
        }
    </script>
@endsection
