    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Editar Doctor</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input value="{{ $doctor->nombre }}" type="text" class="form-control" id="nombre"
                        name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = this.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input value="{{ $doctor->dni }}" type="text" class="form-control" id="dni" name="dni"
                        placeholder="DNI:" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="cmp">CMP</label>
                    <input value="{{ $doctor->cmp }}" type="text" class="form-control" id="cmp"
                        name="cmp" placeholder="CMP" maxlength="6" required>
                </div>
            </div>

            <input type="hidden" id="doctor_id" value="{{ $doctor->id }}">


            <div class="form-group text-center">
                <button onclick="editarDoctor()" type="button" class="btn btn-primary">
                    Editar Doctor
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

        function editarDoctor() {

            let nombre = document.getElementById('nombre').value;
            let dni = document.getElementById('dni').value;
            let cmp = document.getElementById('cmp').value;
            let doctor_id = document.getElementById('doctor_id').value;

            if (nombre == '' || dni == '' || cmp == '') {
                Swal.fire("Alerta", "Todos los campos son obligatorios", "warning");
                return;
            } else if (dni.length < 8) {
                Swal.fire("Alerta", "El DNI debe tener 8 dígitos", "warning");
            } else if (cmp.length < 6) {
                Swal.fire("Alerta", "El CMP debe tener 6 dígitos", "warning");
            } else {
                let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('cmp', cmp);
                formData.append('doctor_id', doctor_id);

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
                            url: "{{ url('editarDatosDoctor') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    Swal.fire("Éxito", "Doctor editado correctamente.", "success")
                                        .then(
                                            () => {
                                                window.location.href = '{{ url('doctores') }}';
                                            });

                                } else {
                                    Swal.fire("Error", "Ocurrió un error al editar el doctor.",
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
