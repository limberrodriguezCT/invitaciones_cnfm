<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre_completo',
        'carrera',
        'grupo',
        'cedula',
        'caso_especial',
        'asistencia_confirmada',
        'confirmado_en',
    ];

    protected $casts = [
        'caso_especial' => 'boolean',
        'asistencia_confirmada' => 'boolean',
        'confirmado_en' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'codigo';
    }
}