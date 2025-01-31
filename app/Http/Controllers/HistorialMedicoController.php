<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function historialMedico() {
        return view('pacientes.historialMedico');
    }
}
