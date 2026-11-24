<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->boolean('no_asistira')->default(false)->after('confirmado_en');
            $table->timestamp('rechazado_en')->nullable()->after('no_asistira');
        });
    }

    public function down(): void
    {
        Schema::table('graduates', function (Blueprint $table) {
            $table->dropColumn(['no_asistira', 'rechazado_en']);
        });
    }
};