<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Publico;

class UserQuestions extends Component
{
    public $gustos_musicales = '';
    public $tipo_eventos_favoritos = '';
    public $comunidad_autonoma = '';
    public $provincia = '';
    public $localidad = '';
    public $notificaciones = false;

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

    public function updatedRegion()
    {
        // Only clear if the province doesn't belong to the new region
        $provincesInRegion = $this->provinces;
        if ($this->provincia && !in_array($this->provincia, $provincesInRegion)) {
            $this->provincia = '';
        }
    }

    public function updatedProvince()
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

        // Return all provinces sorted if no region is selected
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
        return view('livewire.auth.user-questions');
    }

    public function submit()
    {
        $validated = $this->validate([
            'comunidad_autonoma' => 'required',
            'provincia' => 'required',
            'localidad' => 'required',
            'gustos_musicales' => 'required|string',
            'tipo_eventos_favoritos' => 'required|string',
            'notificaciones' => 'boolean',
        ]);

        Publico::create([
            'id_usuario' => auth()->id(),
            'comunidad_autonoma' => $this->comunidad_autonoma,
            'provincia' => $this->provincia,
            'localidad' => $this->localidad,
            'gustos_musicales' => $this->gustos_musicales,
            'tipo_eventos_favoritos' => $this->tipo_eventos_favoritos,
            'notificaciones' => $this->notificaciones,
        ]);

        return redirect()->route('public.area')->with('success', '¡Perfil creado con éxito!');
    }
}
