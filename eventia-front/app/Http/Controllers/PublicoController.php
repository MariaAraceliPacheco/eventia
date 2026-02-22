<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publico;
use App\Livewire\Auth\UserQuestions;
use Illuminate\Routing\Route;

class PublicoController extends Controller
{

    //guardar datos del perfil
    public function store(\App\Http\Requests\StorePublicoRequest $request)
    {
        //se obtiene el usuario que ha iniciado sesion, para asi poder acceder a su id
        $user = auth()->user();

        // Los datos ya están validados gracias al Form Request
        $validated = $request->validated();

        try {
            self::createProfile($validated, $user->id);
            return redirect()->route('public.area')->with('success', 'Perfil creado correctamente');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al guardar el perfil: ' . $e->getMessage());
        }
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
