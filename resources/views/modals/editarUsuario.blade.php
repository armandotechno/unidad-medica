    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Editar Usuario</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input value="{{ $usuario->nombre_completo }}" type="text" class="form-control" id="nombre"
                        name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input value="{{ $usuario->dni }}" type="text" class="form-control" id="dni" name="dni"
                        placeholder="DNI:" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input value="{{ $usuario->usuario }}" type="text" class="form-control" id="usuario"
                        name="usuario" placeholder="Usuario" maxlength="32" required>
                </div>
            </div>

            <input type="hidden" id="usuario_id" value="{{ $usuario->id }}">


            <div class="form-group text-center">
                <button onclick="editarUsuario()" type="button" class="btn btn-primary">
                    Editar Usuario
                </button>
            </div>
        </form>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
        Swal.setDefaults({
            backdrop: false // Desactiva el backdrop por defecto
        });

        function editarUsuario() {

            let nombre = document.getElementById('nombre').value;
            let dni = document.getElementById('dni').value;
            let usuario = document.getElementById('usuario').value;
            let usuario_id = document.getElementById('usuario_id').value;

            if (nombre == '' || dni == '' || usuario == '') {
                Swal.fire("Alerta", "Todos los campos son obligatorios", "warning");
                return;
            } else if (dni.length < 8) {
                Swal.fire("Alerta", "El DNI debe tener 8 dígitos", "warning");
            } else {
                let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('usuario', usuario);
                formData.append('usuario_id', usuario_id);

                Swal.fire({
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
                            url: "{{ url('editarDatosUsuario') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire("Éxito", "Usuario registrado correctamente.", "success")
                                        .then(
                                            () => {
                                                window.location.href = '{{ url('usuarios') }}';
                                            });

                                } else {
                                    Swal.fire("Error", "Ocurrió un error al registrar el usuario.",
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
