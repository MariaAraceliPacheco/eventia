<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ayuntamiento;

class AyuntamientoController extends Controller
{

    public function store(Request $request)
    {
        //se obtiene el usuario que ha iniciado sesion, para asi poder acceder a su id
        $user = auth()->user();

        //validacion de los campos del formulario
        $validated = $request->validate([
            'nombre_institucion' => 'required',
            'imagen' => 'required',
            'comunidad_autonoma' => 'required',
            'localidad' => 'required',
            'provincia' => 'required',
            'telefono' => 'required',
            'email_contacto' => 'required',
            'tipo_evento' => 'required|in:' . implode(',', Ayuntamiento::TIPO_EVENTO),
            'frecuencia' => 'required|in:' . implode(',', Ayuntamiento::FRECUENCIA),
            'tipo_espacio' => 'required|in:' . implode(',', Ayuntamiento::TIPO_ESPACIO),
            'opciones_accesibilidad' => 'sometimes',
            'tipo_facturacion' => 'required|in:' . implode(',', Ayuntamiento::TIPO_FACTURACION),
            'logistica_propia' => 'sometimes',
        ]);

        Ayuntamiento::create([
            'user_id' => $user->id,
            ...$validated, //otra forma de crear el usuario poniendo todos 
            // los campos obligatorios que ha puesto
        ]);

        return redirect()->route('town-hall.area')->with('success', 'Perfil creado correctamente');
    }
}
