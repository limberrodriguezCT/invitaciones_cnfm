<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\JsonResponse;

class InvitationController extends Controller
{
    public function show(Graduate $graduate)
    {
        return view('invitation.show', compact('graduate'));
    }

    public function confirm(Graduate $graduate): JsonResponse
    {
        if ($graduate->asistencia_confirmada) {
            return response()->json([
                'status' => 'already_confirmed',
                'confirmado_en' => $graduate->confirmado_en?->format('d/m/Y h:i A'),
            ], 409);
        }

        $graduate->update([
            'asistencia_confirmada' => true,
            'confirmado_en' => now(),
            'no_asistira' => false,
            'rechazado_en' => null,
        ]);

        return response()->json([
            'status' => 'confirmed',
            'confirmado_en' => $graduate->confirmado_en->format('d/m/Y h:i A'),
        ]);
    }

    public function decline(Graduate $graduate): JsonResponse
    {
        if ($graduate->no_asistira) {
            return response()->json([
                'status' => 'already_declined',
                'rechazado_en' => $graduate->rechazado_en?->format('d/m/Y h:i A'),
            ], 409);
        }

        $graduate->update([
            'asistencia_confirmada' => false,
            'confirmado_en' => null,
            'no_asistira' => true,
            'rechazado_en' => now(),
        ]);

        return response()->json([
            'status' => 'declined',
            'rechazado_en' => $graduate->rechazado_en->format('d/m/Y h:i A'),
        ]);
    }
}