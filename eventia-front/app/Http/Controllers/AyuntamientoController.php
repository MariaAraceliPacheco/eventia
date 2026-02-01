<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayuntamiento;

class AyuntamientoController extends Controller
{

    public function store(Request $request)
    {
        // se obtiene el usuario que ha iniciado sesion
        $user = auth()->user();

        // validacion de los campos del formulario
        $validated = $request->validate([
            'nombre_institucion' => 'required|string',
            'imagen' => 'required', // Se asume que viene la ruta de la imagen
            'comunidad_autonoma' => 'required|string',
            'localidad' => 'required|string',
            'provincia' => 'required|string',
            'telefono' => 'required|string',
            'email_contacto' => 'required|email',
            'tipo_evento' => 'required',
            'frecuencia' => 'required',
            'tipo_espacio' => 'required',
            'opciones_accesibilidad' => 'sometimes',
            'tipo_facturacion' => 'required',
            'logistica_propia' => 'sometimes',
        ]);

        self::createProfile($validated, $user->id);

        return redirect()->route('town-hall.area')->with('success', 'Perfil creado correctamente');
    }

    /**
     * Lógica compartida para crear el perfil de ayuntamiento.
     */
    public static function createProfile(array $data, int $userId)
    {
        return Ayuntamiento::create([
            'id_usuario' => $userId,
            'nombre_institucion' => $data['nombre_institucion'],
            'imagen' => $data['imagen'],
            'comunidad_autonoma' => $data['comunidad_autonoma'],
            'localidad' => $data['localidad'],
            'provincia' => $data['provincia'],
            'telefono' => $data['telefono'],
            'email_contacto' => $data['email_contacto'] ?? auth()->user()->email,
            'tipo_evento' => $data['tipo_evento'],
            'frecuencia' => $data['frecuencia'],
            'tipo_espacio' => $data['tipo_espacio'],
            'opciones_accesibilidad' => $data['opciones_accesibilidad'] ?? null,
            'tipo_facturacion' => $data['tipo_facturacion'],
            'logistica_propia' => $data['logistica_propia'] ?? null,
        ]);
    }
}
