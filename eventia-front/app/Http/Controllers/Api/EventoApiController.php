<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoApiController extends Controller
{
    /**
     * Get all events (paginated).
     */
    public function index()
    {
        $eventos = Evento::with(['ayuntamiento', 'artistas'])
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(15);

        return response()->json($eventos);
    }

    /**
     * Get events for a specific town hall.
     */
    public function byAyuntamiento($id)
    {
        $eventos = Evento::with(['ayuntamiento', 'artistas'])
            ->where('id_ayuntamiento', $id)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        if ($eventos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron eventos para este ayuntamiento'], 404);
        }

        return response()->json($eventos);
    }

    /**
     * Get events for a specific province.
     */
    public function byProvincia($provincia)
    {
        $eventos = Evento::with(['ayuntamiento', 'artistas'])
            ->where('provincia', 'like', '%' . $provincia . '%')
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        if ($eventos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron eventos para esta provincia'], 404);
        }

        return response()->json($eventos);
    }
}
