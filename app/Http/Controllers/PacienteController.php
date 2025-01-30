<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Goblocal;
use App\Models\Paciente;
use App\Models\Provincia;
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
        $distritos = Distrito::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $gobierno_local = Goblocal::all();

        return view('pacientes.registrarPacientes', compact('tiposDeSangre', 'distritos', 'departamentos', 'provincias', 'gobierno_local'));
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
        $paciente->departamento_id = $datos['departamento'];
        $paciente->provincia_id = $datos['provincia'];
        $paciente->distrito_id = $datos['distrito'];
        $paciente->goblocal_id = $datos['gobierno_local'];
        $paciente->direccion = $datos['direccion'];
        $paciente->ubihistoria = $datos['ubicacion_historia'];
        $paciente->save();

        return 1;
    }
}
