@extends('layouts.sidebar')
@section('title', 'Nuevo Usuario')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/registrarPaciente.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Nuevo Usuario</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
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
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                </div>
            </div>



            <div class="form-group text-center">
                <button onclick="crearUsuario()" type="button" class="btn btn-primary">
                    CREAR USUARIO
                </button>
            </div>

            <div class="form-group text-center">
                <a href="{{ '/usuarios' }}"
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
        const crearUsuario = () => {
            const nombre = document.getElementById('nombre').value;
            const dni = document.getElementById('dni').value;
            const usuario = document.getElementById('usuario').value;
            const password = document.getElementById('password').value;

            if (nombre === '' || dni === '' || usuario === '' || password === '') {
                swal("Alerta", "Todos los campos son obligatorios.", "warning");
            } else if (dni.length < 8) {
                swal("Alerta", "El DNI debe tener 8 dígitos.", "warning");
            } else if (password.length < 8) {
                swal("Alerta", "La contraseña debe tener al menos 8 caracteres.", "warning");
            } else if (usuario.length < 6) {
                swal("Alerta", "El nombre de usuario debe tener al menos 6 caracteres.", "warning");
            } else {

                let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('usuario', usuario);
                formData.append('password', password);

                swal({
                    title: 'Confirmación',
                    text: "¿Está seguro que quiere guardar los datos suministrados? Esta opción será irreversible",
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
                            url: "{{ url('crearUsuario') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    swal("Éxito", "Usuario creado exitosamente.", "success").then(
                                        () => {
                                            window.location.href = '{{ url('usuarios') }}';
                                        });

                                } else {
                                    swal("Error", "Ocurrió un error al crear el usuario.", "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                swal("Error", "Ocurrió un error en la solicitud: " + error,
                                "error");
                            }
                        });
                    }
                });
            }
        }
    </script>
@endsection
