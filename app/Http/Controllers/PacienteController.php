<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function registrarPacientes() {
        return view('pacientes.registrarPacientes');
    }
}
