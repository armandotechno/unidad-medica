<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function historialMedico() {

        $medicos = Medico::all();

        return view('pacientes.historialMedico', compact('medicos'));
    }

    public function citas() {
        return view('pacientes.citas');
    }

    public function buscarCitas(Request $request) {
        // dd($request->dni);

        $cita = Cita::where('dni', $request->dni)->get();

        if ($cita->isNotEmpty()) {
            // Almacena la cita en la sesión
            session(['cita' => $cita]);

            return response()->json([
                'success' => true,
                'redirect' => route('historialMedico'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No tiene cita'
            ]);
        }
    }

    public function guardarConsulta(Request $request) {

        dd($request->all());
    }
}
