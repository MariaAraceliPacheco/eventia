<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class ArtistQuestions extends Component
{
    use WithFileUploads;

    public $name = '';
    public $logo;
    public $description = '';
    public $type = 'solista'; // solista or banda
    public $genre = '';
    public $memberCount = 1;
    public $phone = '';
    public $referencePrice = '';
    public $hasTechnicalEquipment = false;
    public $billingPreference = 'platform'; // platform or email

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.artist-questions');
    }

    public function submit()
    {
        // Logic to save artist profile will go here
        return redirect()->route('artist.area');
    }
}
