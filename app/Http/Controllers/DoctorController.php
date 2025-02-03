<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

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



        $doctor = new Medico();
        $doctor->nombre = $request->nombre;
        // $doctor->dni = $request->dni;
        // $doctor->especialidad = $request->especialidad;
        // $doctor->estatus_id = 1;
        $doctor->save();

        return 1;
    }
}

// Agregar CMP ( código ) a la tabla de doctores con el DNI
// En historial médico agregar un buscador de DNI para ver si tiene una cita pendiente de caso contrario registrar
