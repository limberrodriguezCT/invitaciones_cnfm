<?php

namespace App\Imports;

use App\Models\Graduate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use RuntimeException;

class GraduatesImport implements ToCollection
{
    public string $carrera = '';
    public ?string $grupo = null;
    public int $importedCount = 0;
    public int $updatedCount = 0;
    public int $skippedInactiveCount = 0;

    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            throw new RuntimeException('El archivo Excel está completamente vacío.');
        }

        $headerRowIndex = null;
        $colCodigo = null;
        $colNombre = null;
        $colCedula = null;
        $colEspecial = null;
        $colEstado = null;
        $colCarreraInline = null;

        foreach ($rows as $rowIndex => $row) {
            $cells = $row->toArray();

            foreach ($cells as $colIndex => $cellValue) {
                $text = $this->cleanText($cellValue);
                $upper = mb_strtoupper($text);

                if (in_array($upper, ['EVENTO:', 'EVENTO', 'CARRERA:', 'CARRERA'], true) && $this->carrera === '') {
                    $foundCareer = $this->findNextNonEmptyValue($cells, $colIndex + 1);
                    if ($foundCareer !== '') {
                        $this->carrera = $foundCareer;
                    }
                }

                if (in_array($upper, ['GRUPO:', 'GRUPO'], true) && $this->grupo === null) {
                    $foundGroup = $this->findNextNonEmptyValue($cells, $colIndex + 1);
                    if ($foundGroup !== '') {
                        $this->grupo = $foundGroup;
                    }
                }

                if (in_array($upper, ['NOMBRE DEL PARTICIPANTE', 'NOMBRE_COMPLETO', 'NOMBRE COMPLETO'], true)) {
                    $headerRowIndex = $rowIndex;
                    $colNombre = $colIndex;
                }
            }

            if ($headerRowIndex === $rowIndex) {
                foreach ($cells as $colIndex => $cellValue) {
                    $upper = mb_strtoupper($this->cleanText($cellValue));

                    if (in_array($upper, ['N° ÚNICO DE PERSONA', 'N° UNICO DE PERSONA', 'NO ÚNICO DE PERSONA', 'CODIGO', 'CÓDIGO'], true)) {
                        $colCodigo = $colIndex;
                    } elseif (in_array($upper, ['CÉDULA', 'CEDULA'], true)) {
                        $colCedula = $colIndex;
                    } elseif (in_array($upper, ['MAT. CASO ESPECIAL', 'CASO ESPECIAL'], true)) {
                        $colEspecial = $colIndex;
                    } elseif ($upper === 'ESTADO') {
                        $colEstado = $colIndex;
                    } elseif (in_array($upper, ['CARRERA', 'EVENTO'], true)) {
                        $colCarreraInline = $colIndex;
                    }
                }
                break;
            }
        }

        if ($headerRowIndex === null || $colNombre === null) {
            throw new RuntimeException('La estructura del archivo no coincide con el formato de listado de estudiantes del INATEC. Verifique que contenga la columna "NOMBRE DEL PARTICIPANTE".');
        }

        DB::transaction(function () use ($rows, $headerRowIndex, $colCodigo, $colNombre, $colCedula, $colEspecial, $colEstado, $colCarreraInline) {
            foreach ($rows as $rowIndex => $row) {
                if ($rowIndex <= $headerRowIndex) {
                    continue;
                }

                $cells = $row->toArray();
                $rawNombre = $this->cleanText($cells[$colNombre] ?? '');

                if ($rawNombre === '') {
                    continue;
                }

                $upperNombre = mb_strtoupper($rawNombre);
                if (in_array($upperNombre, ['NOMBRE DEL PARTICIPANTE', 'NOMBRE_COMPLETO', 'NOMBRE COMPLETO'], true)) {
                    continue;
                }

                if ($colEstado !== null) {
                    $estado = mb_strtolower($this->cleanText($cells[$colEstado] ?? ''));
                    if ($estado !== '' && $estado !== 'activo') {
                        $this->skippedInactiveCount++;
                        continue;
                    }
                }

                $rowCarrera = $this->carrera;
                if ($colCarreraInline !== null) {
                    $inlineVal = $this->cleanText($cells[$colCarreraInline] ?? '');
                    if ($inlineVal !== '') {
                        $rowCarrera = $inlineVal;
                    }
                }

                if ($rowCarrera === '') {
                    throw new RuntimeException('No se pudo identificar el nombre de la carrera en el encabezado del archivo ("Evento:").');
                }

                $rawCodigo = $colCodigo !== null ? $this->cleanText($cells[$colCodigo] ?? '') : '';
                $cedula = $colCedula !== null ? $this->cleanText($cells[$colCedula] ?? '') : '';
                $especialRaw = $colEspecial !== null ? mb_strtoupper($this->cleanText($cells[$colEspecial] ?? '')) : '';
                $isCasoEspecial = in_array($especialRaw, ['X', 'SI', 'SÍ', '1'], true);

                if ($rawCodigo !== '') {
                    $codigoFinal = mb_strtoupper($rawCodigo);
                } elseif ($cedula !== '') {
                    $codigoFinal = mb_strtoupper($cedula);
                } else {
                    $hash = strtoupper(substr(md5($rowCarrera . '|' . ($this->grupo ?? '') . '|' . $upperNombre), 0, 8));
                    $codigoFinal = 'ESP-' . $hash;
                }

                $existing = Graduate::where('codigo', $codigoFinal)->first();

                if ($existing) {
                    $existing->update([
                        'nombre_completo' => $rawNombre,
                        'carrera' => $rowCarrera,
                        'grupo' => $this->grupo ?? $existing->grupo,
                        'cedula' => $cedula !== '' ? $cedula : $existing->cedula,
                        'caso_especial' => $isCasoEspecial,
                    ]);
                    $this->updatedCount++;
                } else {
                    Graduate::create([
                        'codigo' => $codigoFinal,
                        'nombre_completo' => $rawNombre,
                        'carrera' => $rowCarrera,
                        'grupo' => $this->grupo,
                        'cedula' => $cedula !== '' ? $cedula : null,
                        'caso_especial' => $isCasoEspecial,
                    ]);
                    $this->importedCount++;
                }
            }
        });

        if ($this->importedCount === 0 && $this->updatedCount === 0) {
            throw new RuntimeException('No se encontraron estudiantes activos válidos para registrar en el archivo proporcionado.');
        }
    }

    private function cleanText(mixed $value): string
    {
        if ($value === null || $value instanceof \DateTimeInterface) {
            return '';
        }

        $str = trim((string) $value);
        return preg_replace('/\s+/u', ' ', $str) ?? '';
    }

    private function findNextNonEmptyValue(array $cells, int $startIndex): string
    {
        $max = count($cells);
        for ($i = $startIndex; $i < $max; $i++) {
            $cleaned = $this->cleanText($cells[$i] ?? '');
            if ($cleaned !== '') {
                return $cleaned;
            }
        }
        return '';
    }
}