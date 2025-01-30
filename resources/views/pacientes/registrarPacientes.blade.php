@extends('layouts.sidebar')
@section('title', 'Registrar Pacientes')
@section('stylesheets')
    @parent
    <style>
        .form-control {
            border-radius: 20px;
            background-color: #ededf4;
            padding: 10px 15px;
            height: 50px;
        }

        .btn-primary {
            border-radius: 0;
            padding: 10px 30px;
            background-color: #040404;
            border: none;
            outline: none;
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: none;
        }

        .centered-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 300px;
            text-align: center;
        }

        .form-group textarea {
            width: 240px;
            border-radius: 0;
            border: 1px solid #0e0d0d;
        }
    </style>
@endsection
@section('body')

    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 style="text-align: center; font-weight: bold; font-size: 40px">Registrar Pacientes</h3>
        </div>
    </div>

    <div class="container centered-form" style="margin-top: 20px;">
        <form action="#" method="POST">
            @csrf

            <div class="form-group">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo"
                    maxlength="32" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI:"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" required>
            </div>

            <div class="form-group">
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                    max="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <select class="form-control" style="height: 50px" name="genero" id="genero" required>
                    <option value="">Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" id="nro_historia" name="nro_historia"
                    placeholder="N° Historia clínica" required>
            </div>

            <div class="form-group">
                <select class="form-control" style="height: 50px" name="tipo_sangre" id="tipo_sangre" required>
                    <option value="">Tipo de sangre</option>
                    @foreach ($tiposDeSangre as $tipoDeSangre)
                        <option value="{{ $tipoDeSangre->id }}">{{ $tipoDeSangre->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label style="margin-right: 200px" for="observaciones">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="2" placeholder="XXX......"></textarea>
            </div>

            <div class="form-group text-center">
                <button onclick="registrarPaciente()" type="button" class="btn btn-primary"
                    style="background-color: #040404;">
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
            let observaciones = document.getElementById('observaciones').value;

            if (nombre === '' || dni === '' || fecha_nacimiento === '' || genero === '' || nro_historia === '' || tipo_sangre === '') {
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
            formData.append('observaciones', observaciones);

            $.ajax({
            type: 'POST',
            url: "{{ url('guardarRegistroPaciente') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: formData,
            processData: false, // No procesar los datos
            contentType: false, // No establecer el tipo de contenido
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
    </script>
@endsection
