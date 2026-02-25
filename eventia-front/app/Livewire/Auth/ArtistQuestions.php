<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Http\Controllers\ArtistaController;
use App\Models\Artista;

class ArtistQuestions extends Component
{
    use WithFileUploads;

    public $nombre_artistico = '';
    public $img_logo;
    public $descripcion = '';
    public $tipo = 'solista'; // solista or banda
    public $genero_musical = '';
    public $num_integrantes = 1;
    public $telefono = '';
    public $precio_referencia = '';
    public $equipo_propio = false;
    public $recibir_facturas = 'plataforma'; // plataforma or correo

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.artist-questions');
    }

    public function submit()
    {
        $validated = $this->validate([
            'nombre_artistico' => 'required|string',
            'img_logo' => 'nullable|image|mimes:jpeg,png,webp|max:2048',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:' . implode(',', Artista::TIPO),
            'genero_musical' => 'required|in:' . implode(',', Artista::GENERO_MUSICAL),
            'num_integrantes' => 'required|integer|min:1',
            'telefono' => 'required|string',
            'precio_referencia' => 'required|string',
            'equipo_propio' => 'boolean',
            'recibir_facturas' => 'required|in:' . implode(',', Artista::RECIBIR_FACTURAS),
        ]);

        // Pass logo file to controller logic
        $validated['img_logo'] = $this->img_logo;

        ArtistaController::createProfile($validated, auth()->id());

        return redirect()->route('artist.area')->with('success', '¡Perfil de Artista creado con éxito!');
    }
}
