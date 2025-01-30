<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\TipoSangre;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function pacientes() {

        $pacientes = Paciente::all();

        return view('pacientes.pacientes', compact('pacientes'));
    }

    public function registrarPacientes() {

        $tiposDeSangre = TipoSangre::all();

        return view('pacientes.registrarPacientes', compact('tiposDeSangre'));
    }

    public function guardarRegistroPaciente(Request $request) {
        // dd($request->all());
        $datos = $request->all();
        $paciente = new Paciente();
        $paciente->nombre_completo = $datos['nombre'];
        $paciente->dni = $datos['dni'];
        $paciente->genero = $datos['genero'];
        $paciente->nrohistoria = $datos['nro_historia'];
        $paciente->fecha_nac = $datos['fecha_nacimiento'];
        $paciente->tiposangre_id = $datos['tipo_sangre'];
        $paciente->direccion = 'Caujarito';
        $paciente->ubihistoria = 'Caujarito';
        $paciente->save();

        return 1;
    }
}
