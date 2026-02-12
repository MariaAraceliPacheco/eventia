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
            'img_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'recibir_facturas' => 'required|in:' . implode(',', Artista::RECIBIR_FACTURAS),
        ]);

        if ($request->hasFile('img_logo')) {
            $validated['img_logo'] = self::handleImageUpload($request->file('img_logo'));
        }

        self::createProfile($validated, $user->id);

        return redirect()->route('artist.area')->with('success', 'Perfil creado correctamente');
    }

    /**
     * Lógica compartida para crear el perfil de artista.
     */
    public static function createProfile(array $data, int $userId)
    {
        $logoName = $data['img_logo'] ?? null;

        // Si es un objeto de archivo, lo procesamos
        if ($logoName instanceof \Illuminate\Http\UploadedFile || $logoName instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $logoName = self::handleImageUpload($logoName);
        }

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
            'img_logo' => $logoName,
            'recibir_facturas' => $data['recibir_facturas'],
        ]);
    }

    /**
     * Procesa la subida del logo con el nombre personalizado.
     */
    public static function handleImageUpload($file)
    {
        if (!$file)
            return null;

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('artistas', $filename, 'profiles');

        return $filename;
    }
}
