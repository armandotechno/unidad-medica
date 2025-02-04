<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function doctores() {

        $doctores = Medico::all();

        return view('auth.doctores', compact('doctores'));
    }

    public function nuevoDoctor() {

        return view('auth.nuevoDoctor');

    }

    public function crearDoctor(Request $request) {

        $doctorExistente = Medico::where('dni', $request->dni)->first();
        $cmpExistente = Medico::where('cmp', $request->cmp)->first();

        if ($doctorExistente) {
            return 2;
        }

        if ($cmpExistente) {
            return 3;
        }

        $doctor = new Medico();
        $doctor->nombre = $request->nombre;
        $doctor->dni = $request->dni;
        $doctor->cmp = $request->cmp;
        $doctor->doctor_created = Auth::user()->id;
        $doctor->save();

        return 1;
    }

    public function editarDoctor(Request $request) {

        $doctor = Medico::find($request->doctor_id);

        return view('modals.editarDoctor', compact('doctor'));
    }

    public function editarDatosDoctor(Request $request) {

        Medico::where('id', $request->doctor_id)->update([
            'nombre' => $request->nombre,
            'dni' => $request->dni,
            'cmp' => $request->cmp,
            'doctor_updated' => Auth::user()->id,
            'updated_at' => now()
        ]);

        return 1;
    }

    public function eliminarDoctor(Request $request) {

        Medico::where('id', $request->doctor_id)->delete();

        return response()->json(1);
    }
}

// En historial médico agregar un buscador de DNI para ver si tiene una cita pendiente de caso contrario registrar
