<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function pacientes() {
        return view('pacientes.pacientes');
    }

    public function registrarPacientes() {
        return view('pacientes.registrarPacientes');
    }
}
