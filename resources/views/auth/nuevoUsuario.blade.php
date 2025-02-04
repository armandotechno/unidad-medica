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
                        oninput="this.value = this.value.replace(/[^a-zA-ZñÑ' áéíóúÁÉÍÓÚâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙ`´^]/g, '')"
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
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        required>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label for="password2">Repita su Contraseña</label>
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Repita su Contraseña"
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
        Swal.setDefaults({
            backdrop: false // Desactiva el backdrop por defecto
        });

        const crearUsuario = () => {
            const nombre = document.getElementById('nombre').value;
            const dni = document.getElementById('dni').value;
            const usuario = document.getElementById('usuario').value;
            const password = document.getElementById('password').value;
            const password2 = document.getElementById('password2').value;

            if (nombre === '' || dni === '' || usuario === '' || password === '' || password2 === '') {
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
            } else if (password.length < 8) {
                Swal.fire({
                    type: 'warning',
                    title: 'La contraseña debe tener mínimo 8 caracteres.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else if (usuario.length < 6) {
                Swal.fire({
                    type: 'warning',
                    title: 'El nombre de usuario debe tener al menos 6 caracteres.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                    backdrop: false
                });
            } else if ( password !== password2 ) {
                Swal.fire({
                    type: 'warning',
                    title: 'Las contraseñas deben ser iguales.',
                    confirmButtonText: 'Aceptar',
                    position: 'center',
                })
            } else {

                let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('usuario', usuario);
                formData.append('password', password);

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
                            url: "{{ url('crearUsuario') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire("Éxito", "Usuario creado exitosamente.", "success")
                                        .then(
                                            () => {
                                                window.location.href = '{{ url('usuarios') }}';
                                            });

                                } else if ( data == 2) {
                                    Swal.fire("Alerta", "El nombre de usuario ya está registrado.", "warning")
                                } else if ( data == 3) {
                                    Swal.fire("Alerta", "El DNI ya está registrado.", "warning")
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
