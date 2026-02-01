<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;

class ArtistaController extends Controller
{

    //este metodo se encarga de validar y guardar los datos del artista en la BD
    public function store(Request $request)
    {
        //se obtiene el usuario que ha iniciado sesion, para asi poder acceder a su id
        $user = auth()->user();

        //validacion de los campos del formulario
        $validated = $request->validate([
            'nombre_artistico' => 'required',
            'tipo' => 'required|in:' . implode(',', Artista::TIPO),
            'genero_musical' => 'required|in:' . implode(',', Artista::GENERO_MUSICAL),
            'descripcion' => 'required',
            'precio_referencia' => 'required',
            'telefono' => 'required',
            'equipo_propio' => 'sometimes|boolean',
            'num_integrantes' => 'required',
            'img_logo' => 'required',
            'recibir_facturas' => 'required|in:' . implode(',', Artista::RECIBIR_FACTURAS),
        ]);

        Artista::create([
            'user_id' => $user->id,
            ...$validated, //otra forma de crear el usuario poniendo todos 
            // los campos obligatorios que ha puesto
        ]);

        return redirect()->route('artist.area')->with('success', 'Perfil creado correctamente');
    }
}
