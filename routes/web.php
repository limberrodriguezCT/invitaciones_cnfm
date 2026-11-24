<?php

use App\Http\Controllers\GraduateController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/invitacion/{graduate}', [InvitationController::class, 'show'])
    ->name('invitation.show')
    ->missing(function () {
        return response()->view('invitation.invalid', [], 404);
    });

Route::post('/invitacion/{graduate}/confirmar', [InvitationController::class, 'confirm'])
    ->name('invitation.confirm');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [GraduateController::class, 'index'])->name('dashboard');
    Route::get('/graduates/grupo/{grupo}', [GraduateController::class, 'showGroup'])->name('graduates.group');
    Route::get('/graduates/import', [GraduateController::class, 'createImport'])->name('graduates.import.create');
    Route::post('/graduates/import', [GraduateController::class, 'import'])->name('graduates.import');
    Route::put('/graduates/{graduate}', [GraduateController::class, 'update'])->name('graduates.update');
});

require __DIR__.'/auth.php';