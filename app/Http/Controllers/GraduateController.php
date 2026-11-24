<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportGraduatesRequest;
use App\Imports\GraduatesImport;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class GraduateController extends Controller
{
    public function index()
    {
        $graduates = Graduate::orderBy('carrera')
            ->orderBy('grupo')
            ->orderBy('nombre_completo')
            ->get();

        $stats = [
            'total' => $graduates->count(),
            'confirmados' => $graduates->where('asistencia_confirmada', true)->count(),
            'pendientes' => $graduates->where('asistencia_confirmada', false)->count(),
        ];

        $groups = $graduates->groupBy(function ($item) {
            return $item->grupo ?: 'GENERAL';
        })->map(function ($students, $groupCode) {
            $total = $students->count();
            $confirmados = $students->where('asistencia_confirmada', true)->count();

            return [
                'codigo_grupo' => $groupCode,
                'carrera' => $students->first()->carrera,
                'total' => $total,
                'confirmados' => $confirmados,
                'pendientes' => $total - $confirmados,
                'porcentaje' => $total > 0 ? round(($confirmados / $total) * 100) : 0,
            ];
        })->values();

        return view('dashboard', compact('groups', 'stats'));
    }

    public function showGroup(string $grupo)
    {
        $query = Graduate::orderBy('nombre_completo');

        if ($grupo === 'GENERAL') {
            $query->whereNull('grupo');
        } else {
            $query->where('grupo', $grupo);
        }

        $students = $query->get();

        abort_if($students->isEmpty(), 404);

        $carrera = $students->first()->carrera;
        $total = $students->count();
        $confirmados = $students->where('asistencia_confirmada', true)->count();

        $groupStats = [
            'total' => $total,
            'confirmados' => $confirmados,
            'pendientes' => $total - $confirmados,
            'porcentaje' => $total > 0 ? round(($confirmados / $total) * 100) : 0,
        ];

        return view('graduates.group', compact('students', 'grupo', 'carrera', 'groupStats'));
    }

    public function createImport()
    {
        return view('graduates.import');
    }

    public function import(ImportGraduatesRequest $request)
    {
        try {
            $import = new GraduatesImport();
            Excel::import($import, $request->file('archivo_excel'));

            $grupoTexto = $import->grupo ? " (Grupo {$import->grupo})" : '';
            $mensaje = "Listado de {$import->carrera}{$grupoTexto} procesado correctamente: {$import->importedCount} nuevos registros agregados y {$import->updatedCount} actualizados.";

            if ($import->skippedInactiveCount > 0) {
                $mensaje .= " Se omitieron {$import->skippedInactiveCount} registros por estado inactivo.";
            }

            return redirect()
                ->route('dashboard')
                ->with('success', $mensaje);
        } catch (Throwable $e) {
            return redirect()
                ->route('graduates.import.create')
                ->with('error', 'No se pudo cargar el listado: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Graduate $graduate)
    {
        $validated = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('graduates', 'codigo')->ignore($graduate->id),
            ],
            'nombre_completo' => ['required', 'string', 'max:255'],
            'carrera' => ['required', 'string', 'max:255'],
            'grupo' => ['nullable', 'string', 'max:100'],
            'asistencia_confirmada' => ['required', 'boolean'],
        ]);

        $confirmado = (bool) $validated['asistencia_confirmada'];

        $graduate->update([
            'codigo' => strtoupper(trim($validated['codigo'])),
            'nombre_completo' => mb_strtoupper(trim($validated['nombre_completo']), 'UTF-8'),
            'carrera' => mb_strtoupper(trim($validated['carrera']), 'UTF-8'),
            'grupo' => filled($validated['grupo']) ? strtoupper(trim($validated['grupo'])) : null,
            'asistencia_confirmada' => $confirmado,
            'confirmado_en' => $confirmado
                ? ($graduate->confirmado_en ?? now())
                : null,
        ]);

        $grupoDestino = $graduate->grupo ?: 'GENERAL';

        return redirect()
            ->route('graduates.group', $grupoDestino)
            ->with('success', "Los datos de {$graduate->nombre_completo} se actualizaron correctamente.");
    }
}