<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportGraduatesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'archivo_excel' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'archivo_excel.required' => 'Debe seleccionar un archivo de Excel antes de presionar cargar.',
            'archivo_excel.file' => 'El elemento seleccionado no es un archivo válido.',
            'archivo_excel.mimes' => 'Formato no permitido. Suba únicamente archivos con extensión .xlsx, .xls o .csv.',
            'archivo_excel.max' => 'El archivo supera el tamaño máximo permitido de 10 MB.',
        ];
    }
}