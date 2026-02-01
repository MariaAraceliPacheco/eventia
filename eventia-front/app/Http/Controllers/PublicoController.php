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
            'comunidad_autonoma' => 'required',
            'localidad' => 'required',
            'provincia' => 'required', //los gustos musicales se cogen directamente el modelo
            'gustos_musicales' => 'required|in:' . implode(',', Publico::GUSTOS_MUSICALES),
            'tipo_eventos_favoritos' => 'required|in:' . implode(',', Publico::TIPO_EVENTOS_FAVORITOS),
            'notificaciones' => 'sometimes|boolean', //sometimes significa que no es obligatorio
        ]);

        Publico::create([
            'id_usuario' => $user->id,
            'comunidad_autonoma' => $validated['comunidad_autonoma'],
            'localidad' => $validated['localidad'],
            'provincia' => $validated['provincia'],
            'gustos_musicales' => $validated['gustos_musicales'],
            'tipo_eventos_favoritos' => $validated['tipo_eventos_favoritos'],
            'notificaciones' => $validated['notificaciones'] ?? false,
        ]);

        return redirect()->route('public.area')->with('success', 'Perfil creado correctamente');
    }


}
