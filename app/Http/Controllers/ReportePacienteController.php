<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Medico;
use Illuminate\Http\Request;

class ReportePacienteController extends Controller
{
    public function reportePacientes()
    {
        $medicos = Medico::all();
        return view('pacientes.reportePacientes', compact('medicos'));
    }

    public function reporteTotalAtenciones(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        // dd($fecha_inicio, $fecha_fin);
        if ($fecha_inicio === $fecha_fin) {
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($fecha_fin));
        }

        $consultas = Consulta::with('paciente')->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();
        // dd($consultas);

        return response()->json([
            'success' => true,
            'data' => $consultas
        ]);
    }

    public function reporteConsultasPorMes(Request $request)
    {
        // Obtener el mes y el año de la solicitud
        $mes = $request->input('mes');
        $anio = $request->input('anio');

        // Validar que el mes y el año estén presentes
        if (!$mes || !$anio) {
            return response()->json([
                'success' => false,
                'message' => 'Debes seleccionar un mes y un año válidos.'
            ]);
        }

        // Construir la consulta base
        $query = Consulta::with('paciente')
            ->whereYear('created_at', $anio) // Filtrar por año
            ->whereMonth('created_at', $mes); // Filtrar por mes

        // Obtener los resultados
        $reporte = $query->get();

        // Devolver la data en formato JSON
        return response()->json([
            'success' => true,
            'data' => $reporte
        ]);
    }

    public function reportePorMedico(Request $request)
    {
        // Obtener los parámetros de la solicitud
        $medico_id = $request->input('medico_id');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');

        // Si las fechas son iguales, ajustar fecha_fin para que sea el final del día
        if ($fecha_inicio === $fecha_fin) {
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($fecha_fin));
        }

        // Construir la consulta base
        $query = Consulta::with('paciente')
            ->where('medico_id', $medico_id);

        // Aplicar filtros de fecha si están presentes
        if ($fecha_inicio && $fecha_fin) {
            $query->whereBetween('created_at', [$fecha_inicio, $fecha_fin]);
        }

        // Obtener los resultados
        $reporte = $query->get();

        // Devolver la data en formato JSON
        return response()->json([
            'success' => true,
            'data' => $reporte
        ]);
    }

    public function reporteTipoServicio(Request $request)
    {
        $servicio_id = $request->input('servicio_id');

        // Validar que el tipo de servicio esté presente
        if (!$servicio_id) {
            return response()->json([
                'success' => false,
                'message' => 'Debes seleccionar un tipo de servicio válido.'
            ]);
        }

        // Filtrar las consultas por el tipo de servicio
        $reporte = Consulta::with('paciente')
            ->where('tiposeguro', $servicio_id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reporte
        ]);
    }

    public function reporteConsultasPendientes()
    {
        // Obtener las citas pendientes (estatus_id = 3) que tienen un paciente asociado
        $reporte = Cita::where('estatus_id', 3)
            ->get()
            ->map(function ($cita) {
                $cita->created_at_formatted = $cita->created_at->format('Y-m-d H:i:s');
                return $cita;
            });

        return response()->json([
            'success' => true,
            'data' => $reporte
        ]);
    }
}
