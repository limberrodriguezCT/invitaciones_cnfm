<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function show(Graduate $graduate)
    {
        return view('invitation.show', compact('graduate'));
    }

    public function confirm(Request $request, Graduate $graduate)
    {
        if ($graduate->asistencia_confirmada) {
            return response()->json([
                'success' => true,
                'already_confirmed' => true,
                'message' => 'Su asistencia ya había sido confirmada previamente.',
                'confirmado_en' => $graduate->confirmado_en?->format('d/m/Y h:i A'),
            ], 409);
        }

        $graduate->update([
            'asistencia_confirmada' => true,
            'confirmado_en' => now(),
        ]);

        return response()->json([
            'success' => true,
            'already_confirmed' => false,
            'message' => 'Asistencia confirmada exitosamente.',
            'confirmado_en' => $graduate->confirmado_en->format('d/m/Y h:i A'),
        ]);
    }
}