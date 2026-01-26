<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;

class UserQuestions extends Component
{
    public $name = '';
    public $musicPreferences = [];
    public $eventTypes = [];
    public $region = '';
    public $province = '';
    public $town = '';
    public $wantsAlerts = false;

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
        if ($this->province && !in_array($this->province, $provincesInRegion)) {
            $this->province = '';
        }
    }

    public function updatedProvince()
    {
        if ($this->province) {
            foreach ($this->regions_data as $region => $provinces) {
                if (in_array($this->province, $provinces)) {
                    $this->region = $region;
                    break;
                }
            }
        }
    }

    public function getProvincesProperty()
    {
        if ($this->region) {
            return $this->regions_data[$this->region] ?? [];
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
        // Logic to save preferences will go here
        return redirect()->route('dashboard');
    }
}
