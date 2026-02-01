<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publico;
use App\Livewire\Auth\UserQuestions;
use Illuminate\Routing\Route;

class PublicoController extends Controller
{

    //guardar datos del perfil
    public function store(Request $request)
    {
        //se obtiene el usuario que ha iniciado sesion, para asi poder acceder a su id
        $user = auth()->user();

        //validacion de los campos del formulario
        $validated = $request->validate([
            'comunidad_autonoma' => 'required|string',
            'localidad' => 'required|string',
            'provincia' => 'required|string',
            'gustos_musicales' => 'required|string',
            'tipo_eventos_favoritos' => 'required|string',
            'notificaciones' => 'sometimes|boolean',
        ]);

        self::createProfile($validated, $user->id);

        return redirect()->route('public.area')->with('success', 'Perfil creado correctamente');
    }

    /**
     * Lógica compartida para crear el perfil de público.
     * Puede ser llamada desde este controlador o desde componentes Livewire.
     */
    public static function createProfile(array $data, int $userId)
    {
        return Publico::create([
            'id_usuario' => $userId,
            'comunidad_autonoma' => $data['comunidad_autonoma'],
            'localidad' => $data['localidad'],
            'provincia' => $data['provincia'],
            'gustos_musicales' => $data['gustos_musicales'],
            'tipo_eventos_favoritos' => $data['tipo_eventos_favoritos'],
            'notificaciones' => $data['notificaciones'] ?? false,
        ]);
    }


}
