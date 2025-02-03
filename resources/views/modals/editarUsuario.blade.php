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
                    <input value="{{ $usuario->nombre_completo }}" type="text" class="form-control" id="nombre"
                        name="nombre" placeholder="Nombre completo"
                        oninput="this.value = this.value = input.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ\s]/g, '');"
                        maxlength="32" required>
                </div>
            </div>

            <div class="form-group text-center">
                <button onclick="editarPaciente()" type="button" class="btn btn-primary">
                    Editar Paciente
                </button>
            </div>
        </form>
    </div>
