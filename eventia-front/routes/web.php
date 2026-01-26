<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HomePage;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;

use App\Livewire\Auth\RoleSelection;
use App\Livewire\Auth\UserQuestions;
use App\Livewire\Auth\ArtistQuestions;
use App\Livewire\Auth\TownHallQuestions;

use App\Livewire\TownHall\AreaAyuntamiento;
use App\Livewire\TownHall\CreateEvent;

Route::get('/', HomePage::class);

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/quien-eres', RoleSelection::class)->name('role-selection');
Route::get('/preguntas-usuario', UserQuestions::class)->name('user-questions');
Route::get('/preguntas-artista', ArtistQuestions::class)->name('artist-questions');
Route::get('/preguntas-ayuntamiento', TownHallQuestions::class)->name('town-hall-questions');

// Town Hall Routes
Route::get('/area-ayuntamiento', AreaAyuntamiento::class)->name('town-hall.area');
Route::get('/crear-evento', CreateEvent::class)->name('town-hall.create-event');

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/profile', 'profile')->name('profile.edit');
