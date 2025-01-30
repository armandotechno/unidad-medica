@extends('layouts.sidebar')
@section('title', 'Registrar Pacientes')
@section('stylesheets')
    @parent
    <style>
        .form-control,
        .form-select {
            border: none;
            border-radius: 20px;
            background-color: #ededf4;
            padding: 15px 20px;
            height: 50px;
            width: 100%;
            font-size: 16px;
            color: #333;
        }

        .form-control::placeholder,
        .form-select::placeholder {
            color: #333;
            /* Cambia este valor al color que desees para el placeholder */
        }

        .form-select:focus {
            outline: none;
            box-shadow: none;
            /* border-color: #0e0d0d; Asegúrate de que el borde coincida con el de los inputs */
        }

        .btn-primary {
            border-radius: 20px;
            /* Añadí bordes redondeados al botón */
            padding: 15px 40px;
            /* Aumenté el padding del botón */
            background-color: #040404;
            border: none;
            outline: none;
            font-size: 18px;
            /* Aumenté el tamaño de la fuente del botón */
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: none;
        }

        .centered-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 20px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            flex-wrap: wrap;
            /* gap: 10px; Aumenté el espacio entre los elementos */
            margin-bottom: 20px;
            /* Añadí margen inferior para separar las filas */
        }

        .form-group {
            width: calc(50% - 10px);
            /* Ajusté el ancho para que quepan dos en una fila */
            text-align: left;
            /* Cambié a alineación izquierda para mejor legibilidad */
        }

        .form-group textarea {
            width: 240px;
            border-radius: 0;
            height: 60px;
            border: 1px solid #0e0d0d;
        }

        /* Estilos para pantallas pequeñas */
        @media (max-width: 768px) {
            .form-group {
                width: 100%;
                /* En pantallas pequeñas, cada grupo ocupa el 100% del ancho */
            }

            .form-control {
                width: 100%;
            }

            .form-row {
                flex-direction: column;
            }

            .centered-form {
                padding: 0 10px;
            }
        }

        /* Centrar el botón de "Registrar" */
        .form-group.text-center {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
            /* Añadí margen superior para separar el botón */
        }

        h3 {
            text-align: center;
            font-weight: bold;
            font-size: 40px;
            margin-bottom: 30px;
            /* Añadí margen inferior para separar el título */
        }
    </style>
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
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        max="{{ date('Y-m-d') }}" required>
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
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px';"  placeholder="XXX......"></textarea>
                </div>
            </div>

            <div class="form-group text-center">
                <button onclick="registrarPaciente()" type="button" class="btn btn-primary">
                    Registrar
                </button>
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
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
                swal("Alerta", "Todos los campos son obligatorios", "warning");
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
                        url: "{{ url('guardarRegistroPaciente') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data == 1) {
                                swal("Éxito", "Paciente registrado correctamente.", "success").then(() => {
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
@endsection
