<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre_completo');
            $table->string('carrera');
            $table->string('grupo')->nullable();
            $table->string('cedula')->nullable();
            $table->boolean('caso_especial')->default(false);
            $table->boolean('asistencia_confirmada')->default(false);
            $table->timestamp('confirmado_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};