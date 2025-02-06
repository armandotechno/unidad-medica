<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function historialMedico()
    {

        $medicos = Medico::all();

        return view('pacientes.historialMedico', compact('medicos'));
    }

    public function citas()
    {
        return view('pacientes.citas');
    }

    public function buscarCitas(Request $request)
    {
        // dd($request->dni);

        $cita = Cita::where('dni', $request->dni)->where('estatus_id', 3)->get();

        if ($cita->isNotEmpty()) {

            if ($cita[0]->estatus_id == 4) {
                return response()->json([
                    'success' => false,
                    'message' => 'La cita ya fue atendida.'
                ]);
            } else {
                $paciente = Paciente::where('dni', $request->dni)->first();

                if ($paciente !== null) {
                    session(['paciente_id' => $paciente->id, 'numero_historia' => $paciente->nrohistoria]);
                    session(['cita' => $cita]);

                    return response()->json([
                        'success' => true,
                        'redirect' => route('historialMedico'),
                    ]);
                } else {

                    return response()->json([
                        'success' => false,
                        'message' => 'No hay un paciente registrado con ese DNI.'
                    ]);
                }
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No tiene una cita asignada.'
            ]);
        }
    }

    public function guardarConsulta(Request $request)
    {
        $consulta = new Consulta();
        $consulta->paciente_id = $request->paciente_id;
        $consulta->motivo = $request->motivo_consulta;
        $consulta->nroconsulta = $request->numero_consulta;
        $consulta->nrohistoria = $request->numero_historia;
        $consulta->sintomas = $request->sintomas_actuales;
        $consulta->diagnosticoprin = $request->diagnostico_principal;
        $consulta->diagnosticoadi = $request->diagnostico_adicional;
        $consulta->plantratamiento = $request->plan_tratamiento;
        $consulta->medico_id = $request->medico;
        $consulta->especialidad_id = $request->especialidad;
        $consulta->tiposeguro = $request->tipo_seguro;
        $consulta->medicamentosrecetados = $request->medicamentos_recetados;
        $consulta->estatus_id = 4;
        $consulta->save();

        Cita::where('dni', $request->dni)->update([
            'estatus_id' => 4
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Consulta guardada correctamente.'
        ]);
    }

    public function consultasPrevias()
    {

        return view('pacientes.consultasPrevias');
    }

    public function buscarConsultas(Request $request)
    {
        // Obtener el DNI del request
        $dni = $request->dni;

        // Buscar las consultas con estatus_id 4 y que pertenezcan a un paciente con el DNI especificado
        $consultas = Consulta::where('estatus_id', 4)
            ->whereHas('paciente', function ($query) use ($dni) {
                $query->where('dni', $dni);
            })
            ->get();

        // Verificar si se encontraron consultas
        if ($consultas->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'consultas' => $consultas,
                'redirect' => route('consultasPrevias'), // Redirigir a la vista de consultas previas
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No se encontraron consultas para el DNI proporcionado.',
            ]);
        }
    }

    public function visualizarConsulta(Request $request)
    {
        $consulta = Consulta::find($request->consulta_id);
        // dd($consulta);

        if ($consulta) {
            return view('modals.modalVisualizarConsulta', compact('consulta'));
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Consulta no encontrada.'
            ]);
        }
    }
}
