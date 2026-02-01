<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Http\Controllers\AyuntamientoController;

class TownHallQuestions extends Component
{
    use WithFileUploads;

    // Basic Data
    public $nombre_institucion = '';
    public $imagen;
    public $telefono = '';
    public $comunidad_autonoma = '';
    public $provincia = '';
    public $localidad = '';

    // Events
    public $tipo_evento = '';
    public $frecuencia = '';
    public $tipo_espacio = '';

    // Accessibility
    public $opciones_accesibilidad = '';

    // Billing
    public $tipo_facturacion = 'plataforma';

    // Resources
    public $logistica_propia = '';

    public $regions_data = [
        'Andalucía' => ['Almería', 'Cádiz', 'Córdoba', 'Granada', 'Huelva', 'Jaén', 'Málaga', 'Sevilla'],
        'Aragón' => ['Huesca', 'Teruel', 'Zaragoza'],
        'Asturias' => ['Asturias'],
        'Baleares' => ['Islas Baleares'],
        'Canarias' => ['Las Palmas', 'Santa Cruz de Tenerife'],
        'Cantabria' => ['Cantabria'],
        'Castilla y León' => ['Ávila', 'Burgos', 'León', 'Palencia', 'Salamanca', 'Segovia', 'Soria', 'Valladolid', 'Zamora'],
        'Castilla-La Mancha' => ['Albacete', 'Ciudad Real', 'Cuenca', 'Guadalajara', 'Toledo'],
        'Cataluña' => ['Barcelona', 'Girona', 'Lleida', 'Tarragona'],
        'Comunidad Valenciana' => ['Alicante', 'Castellón', 'Valencia'],
        'Extremadura' => ['Badajoz', 'Cáceres'],
        'Galicia' => ['A Coruña', 'Lugo', 'Ourense', 'Pontevedra'],
        'Madrid' => ['Madrid'],
        'Murcia' => ['Murcia'],
        'Navarra' => ['Navarra'],
        'País Vasco' => ['Álava', 'Bizkaia', 'Gipuzkoa'],
        'La Rioja' => ['La Rioja'],
        'Ceuta' => ['Ceuta'],
        'Melilla' => ['Melilla'],
    ];

    public function updatedComunidadAutonoma()
    {
        $provincesInRegion = $this->provinces;
        if ($this->provincia && !in_array($this->provincia, $provincesInRegion)) {
            $this->provincia = '';
        }
    }

    public function updatedProvincia()
    {
        if ($this->provincia) {
            foreach ($this->regions_data as $region => $provinces) {
                if (in_array($this->provincia, $provinces)) {
                    $this->comunidad_autonoma = $region;
                    break;
                }
            }
        }
    }

    public function getProvincesProperty()
    {
        if ($this->comunidad_autonoma) {
            return $this->regions_data[$this->comunidad_autonoma] ?? [];
        }

        $all = [];
        foreach ($this->regions_data as $provinces) {
            $all = array_merge($all, $provinces);
        }
        sort($all);
        return $all;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.town-hall-questions');
    }

    public function submit()
    {
        $validated = $this->validate([
            'nombre_institucion' => 'required|string',
            'telefono' => 'required|string',
            'comunidad_autonoma' => 'required|string',
            'provincia' => 'required|string',
            'localidad' => 'required|string',
            'tipo_evento' => 'required|string',
            'frecuencia' => 'required|string',
            'tipo_espacio' => 'required|string',
            'opciones_accesibilidad' => 'string',
            'tipo_facturacion' => 'required|string',
            'logistica_propia' => 'string',
        ]);

        // Handle Image Upload
        if ($this->imagen) {
            $validated['imagen'] = $this->imagen->store('profiles/ayuntamientos', 'public');
        } else {
            $validated['imagen'] = null;
        }

        AyuntamientoController::createProfile($validated, auth()->id());

        return redirect()->route('town-hall.area')->with('success', '¡Perfil de Ayuntamiento creado con éxito!');
    }
}
