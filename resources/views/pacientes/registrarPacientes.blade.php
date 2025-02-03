@extends('layouts.sidebar')
@section('title', 'Registrar Pacientes')
@section('stylesheets')
    @parent
        <link rel="stylesheet" href="{{ asset('css/registrarPaciente.css') }}">
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3>Registrar Pacientes</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = this.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="8" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        placeholder="Fecha de Nacimiento" onfocus="(this.type='date')" max="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="genero" id="genero" required>
                        <option value="">Género</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="text" class="form-control" id="nro_historia" name="nro_historia"
                        placeholder="N° Historia clínica" maxlength="8" required>
                </div>

                <div class="form-group">
                    <select class="form-select" name="tipo_sangre" id="tipo_sangre" required>
                        <option value="">Tipo de sangre</option>
                        @foreach ($tiposDeSangre as $tipoDeSangre)
                            <option value="{{ $tipoDeSangre->id }}">{{ $tipoDeSangre->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="distrito" id="distrito" required>
                        <option value="">Distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-select" name="departamento" id="departamento" required>
                        <option value="">Departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="provincia" id="provincia" required>
                        <option value="">Provincia</option>
                        @foreach ($provincias as $provincia)
                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección"
                        required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <select class="form-select" name="gobierno_local" id="gobierno_local" required>
                        <option value="">Gobierno Local</option>
                        @foreach ($gobierno_local as $gobLocal)
                            <option value="{{ $gobLocal->id }}">{{ $gobLocal->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="ubicacion_historia" name="ubicacion_historia"
                        placeholder="Ubicación de la historia" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="observaciones">Observaciones ( opcional )</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';" placeholder="XXX......"></textarea>
                </div>
            </div>

            <div class="form-group text-center">
                <button onclick="registrarPaciente()" type="button" class="btn btn-primary">
                    REGISTRAR
                </button>
            </div>

            <div class="form-group text-center">
                <a href="{{ '/pacientes' }}"
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

        function registrarPaciente() {
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
                Swal.fire("Alerta", "Todos los campos son obligatorios", "warning");
                return;
            }

            let formData = new FormData();
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
                        url: "{{ url('guardarRegistroPaciente') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire("Éxito", "Paciente registrado correctamente.", "success").then(
                                () => {
                                        window.location.href = '{{ url('pacientes') }}';
                                    });

                            } else if ( data == 2) {
                                    Swal.fire("Alerta", "El DNI o el número de historia clínica ya están registrados.", "warning")
                            } else {
                                Swal.fire("Error", "Ocurrió un error al registrar el paciente.", "error");
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
