<?php

namespace App\Http\Controllers;

use App\Models\TipoSangre;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function pacientes() {
        return view('pacientes.pacientes');
    }

    public function registrarPacientes() {

        $tiposDeSangre = TipoSangre::all();

        return view('pacientes.registrarPacientes', compact('tiposDeSangre'));
    }
}
