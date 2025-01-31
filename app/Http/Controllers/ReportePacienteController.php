<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportePacienteController extends Controller
{
    public function reportePacientes() {
        return view('pacientes.reportePacientes');
    }
}
