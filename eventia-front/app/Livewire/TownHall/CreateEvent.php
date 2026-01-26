<?php

namespace App\Livewire\TownHall;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class CreateEvent extends Component
{
    use WithFileUploads;

    public $title = '';
    public $image;
    public $invitedArtists = '';
    public $price = '';
    public $date = '';
    public $category = '';
    public $description = '';
    public $locality = '';
    public $province = '';

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.town-hall.create-event');
    }

    public function submit()
    {
        // Logic to save event
        return redirect()->route('town-hall.area');
    }
}
