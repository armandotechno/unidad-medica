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

        return view('pacientes.registrarPacientes', compact('tiposDeSangre', 'distritos', 'departamentos', 'provincias'));
    }

    public function guardarRegistroPaciente(Request $request) {

        $pacienteExistente = Paciente::where('dni', $request->dni)
            ->orWhere('nrohistoria', $request->nro_historia)
            ->first();

        if ($pacienteExistente) {
            return 2;
        }

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
        $paciente->direccion = $datos['direccion'];
        $paciente->ubihistoria = $datos['ubicacion_historia'];
        $paciente->observaciones = $datos['observaciones'];
        $paciente->save();

        return 1;
    }

    public function editarPaciente(Request $request) {

        $paciente_id = $request->paciente_id;
        $paciente = Paciente::where("id", $paciente_id)->first();
        $tiposDeSangre = TipoSangre::all();
        $distritos = Distrito::all();
        $departamentos = Departamento::all();
        $provincias = Provincia::all();

        return view('modals.editarPaciente', compact('paciente_id', 'paciente', 'tiposDeSangre', 'distritos', 'departamentos', 'provincias'));
    }

    public function editarDatosPaciente(Request $request) {

        Paciente::where("id", $request->paciente_id)->update([
            'nombre_completo' => $request->nombre,
            'dni' => intval($request->dni),
            'genero' => $request->genero,
            'nrohistoria' => $request->nro_historia,
            'fecha_nac' => $request->fecha_nacimiento,
            'tiposangre_id' => $request->tipo_sangre,
            'departamento_id' => $request->departamento,
            'provincia_id' => $request->provincia,
            'distrito_id' => $request->distrito,
            'goblocal_id' => $request->gobierno_local,
            'direccion' => $request->direccion,
            'ubihistoria' => $request->ubicacion_historia,
            'observaciones' => $request->observaciones,
        ]);

        return response()->json(1);

    }

    public function eliminarPaciente(Request $request) {

        $paciente = Paciente::where('id', $request->paciente_id)->first();
        $paciente->delete();

        return response()->json(2);

    }
}
