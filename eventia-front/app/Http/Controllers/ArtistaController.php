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
            'nombre_artistico' => 'required|string',
            'tipo' => 'required|in:' . implode(',', Artista::TIPO),
            'genero_musical' => 'required|in:' . implode(',', Artista::GENERO_MUSICAL),
            'descripcion' => 'required|string',
            'precio_referencia' => 'required|string',
            'telefono' => 'required|string',
            'equipo_propio' => 'sometimes|boolean',
            'num_integrantes' => 'required|integer',
            'img_logo' => 'required',
            'recibir_facturas' => 'required|in:' . implode(',', Artista::RECIBIR_FACTURAS),
        ]);

        self::createProfile($validated, $user->id);

        return redirect()->route('artist.area')->with('success', 'Perfil creado correctamente');
    }

    /**
     * Lógica compartida para crear el perfil de artista.
     */
    public static function createProfile(array $data, int $userId)
    {
        return Artista::create([
            'id_usuario' => $userId,
            'nombre_artistico' => $data['nombre_artistico'],
            'tipo' => $data['tipo'],
            'genero_musical' => $data['genero_musical'],
            'descripcion' => $data['descripcion'],
            'precio_referencia' => $data['precio_referencia'],
            'telefono' => $data['telefono'],
            'equipo_propio' => $data['equipo_propio'] ?? false,
            'num_integrantes' => $data['num_integrantes'] ?? 1,
            'img_logo' => $data['img_logo'],
            'recibir_facturas' => $data['recibir_facturas'],
        ]);
    }
}
