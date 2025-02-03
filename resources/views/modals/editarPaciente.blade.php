    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Editar Paciente</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input value="{{ $paciente->nombre_completo }}" type="text" class="form-control" id="nombre"
                        name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <input value="{{ $paciente->dni }}" type="text" class="form-control" id="dni"
                        name="dni" placeholder="DNI:" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        maxlength="12" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input value="{{ $paciente->fecha_nac }}" type="date" class="form-control" id="fecha_nacimiento"
                        name="fecha_nacimiento" max="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="genero" id="genero" required>
                        <option value="">Género</option>
                        <option value="M" {{ $paciente->genero == 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ $paciente->genero == 'F' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input value="{{ $paciente->nrohistoria }}" type="text" class="form-control" id="nro_historia"
                        name="nro_historia" placeholder="N° Historia clínica" maxlength="8" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="tipo_sangre" id="tipo_sangre" required>
                        <option value="">Tipo de sangre</option>
                        @foreach ($tiposDeSangre as $tipoDeSangre)
                            <option value="{{ $tipoDeSangre->id }}"
                                {{ $paciente->tiposangre_id == $tipoDeSangre->id ? 'selected' : '' }}>
                                {{ $tipoDeSangre->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="distrito" id="distrito" required>
                        <option value="">Distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}"
                                {{ $paciente->distrito_id == $distrito->id ? 'selected' : '' }}>
                                {{ $distrito->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-select" name="departamento" id="departamento" required>
                        <option value="">Departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}"
                                {{ $paciente->departamento_id == $departamento->id ? 'selected' : '' }}>
                                {{ $departamento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="provincia" id="provincia" required>
                        <option value="">Provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}"
                                {{ $paciente->provincia_id == $provincia->id ? 'selected' : '' }}>
                                {{ $provincia->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input value="{{ $paciente->direccion }}" type="text" class="form-control" id="direccion"
                        name="direccion" placeholder="Dirección" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="gobierno_local" id="gobierno_local" required>
                        <option value="">Gobierno Local</option>
                        @foreach ($gobierno_local as $gobLocal)
                            <option value="{{ $gobLocal->id }}"
                                {{ $paciente->goblocal_id == $gobLocal->id ? 'selected' : '' }}>
                                {{ $gobLocal->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input value="{{ $paciente->ubihistoria }}" type="text" class="form-control"
                        id="ubicacion_historia" name="ubicacion_historia" placeholder="Ubicación de la historia"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" placeholder="XXX......">{{ $paciente->observaciones }}</textarea>
                </div>
            </div>

            <input type="hidden" id="paciente_id" value="{{ $paciente_id }}">

            <div class="form-group text-center">
                <button onclick="editarPaciente()" type="button" class="btn btn-primary">
                    Editar Paciente
                </button>
            </div>
        </form>
    </div>

    @section('javascripts')
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

        <script>
            function editarPaciente() {
                let paciente_id = document.getElementById('paciente_id').value;
                let nombre = document.getElementById('nombre').value;
                let dni = document.getElementById('dni').value;
                let fecha_nacimiento = document.getElementById('fecha_nacimiento').value;
                let genero = document.getElementById('genero').value;
                let nro_historia = document.getElementById('nro_historia').value;
                let tipo_sangre = document.getElementById('tipo_sangre').value;
                let distrito = document.getElementById('distrito').value;
                let departamento = document.getElementById('departamento').value;
                let provincia = document.getElementById('provincia').value;
                let direccion = document.getElementById('direccion').value;
                let gobierno_local = document.getElementById('gobierno_local').value;
                let ubicacion_historia = document.getElementById('ubicacion_historia').value;
                let observaciones = document.getElementById('observaciones').value;

                if (nombre === '' || dni === '' || fecha_nacimiento === '' || genero === '' || nro_historia === '' ||
                    tipo_sangre === '' || distrito === '' || departamento === '' || provincia === '' || direccion === '') {
                    swal("Alerta", "Todos los campos son obligatorios", "warning");
                    return;
                }

                let formData = new FormData();
                formData.append('paciente_id', paciente_id);
                formData.append('nombre', nombre);
                formData.append('dni', dni);
                formData.append('fecha_nacimiento', fecha_nacimiento);
                formData.append('genero', genero);
                formData.append('nro_historia', nro_historia);
                formData.append('tipo_sangre', tipo_sangre);
                formData.append('distrito', distrito);
                formData.append('departamento', departamento);
                formData.append('provincia', provincia);
                formData.append('direccion', direccion);
                formData.append('gobierno_local', gobierno_local);
                formData.append('ubicacion_historia', ubicacion_historia);
                formData.append('observaciones', observaciones);

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
                            url: "{{ url('editarDatosPaciente') }}",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data == 1) {
                                    swal("Éxito", "Paciente registrado correctamente.", "success").then(
                                    () => {
                                            window.location.href = '{{ url('pacientes') }}';
                                        });

                                } else {
                                    swal("Error", "Ocurrió un error al registrar el paciente.", "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                swal("Error", "Ocurrió un error en la solicitud: " + error, "error");
                            }
                        });
                    }

                });
            }
        </script>
