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
use App\Livewire\Public\EventDetail;
use App\Livewire\Public\TownHallProfile;
use App\Livewire\Public\TownHallList;
use App\Livewire\Public\ArtistList;
use App\Livewire\Admin\Admin;
use App\Http\Controllers\PublicoController;

Route::get('/', HomePage::class);

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/quien-eres', RoleSelection::class)->name('role-selection');
Route::get('/preguntas-usuario', UserQuestions::class)->name('user-questions');
Route::get('/preguntas-artista', ArtistQuestions::class)->name('artist-questions');
Route::get('/preguntas-ayuntamiento', TownHallQuestions::class)->name('town-hall-questions');

// Event Details & Public Profiles
Route::get('/evento/{id}', EventDetail::class)->name('public.event-detail');
Route::get('/ayuntamiento/{id}', TownHallProfile::class)->name('public.town-hall-profile');
Route::get('/ayuntamientos', TownHallList::class)->name('public.town-hall-list');
Route::get('/artistas', ArtistList::class)->name('public.artist-list');
Route::get('/artista/{id}', \App\Livewire\Public\ArtistProfile::class)->name('public.artist-profile');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Town Hall Area (Only ayuntamiento)
    Route::middleware(['role:ayuntamiento,admin'])->group(function () {
        Route::get('/area-ayuntamiento', AreaAyuntamiento::class)->name('town-hall.area');
        Route::get('/crear-evento', CreateEvent::class)->name('town-hall.create-event');
        Route::get('/editar-evento/{id}', CreateEvent::class)->name('town-hall.edit-event');
    });

    // Artist Area (Only artista)
    Route::middleware(['role:artista'])->group(function () {
        Route::get('/area-artista', \App\Livewire\Artist\AreaArtista::class)->name('artist.area');
    });

    // Public Area (Only publico + admin for viewing)
    Route::middleware(['role:publico,admin'])->group(function () {
        Route::get('/area-publico/{id?}', \App\Livewire\Public\AreaPublico::class)->name('public.area');
        Route::get('/compra-entrada', \App\Livewire\Public\BuyTicket::class)->name('public.buy-ticket');
        Route::get('/pago', \App\Livewire\Public\PaymentCheckout::class)->name('public.payment-checkout');
    });

    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/profile', 'profile')->name('profile.edit');

    // Admin Area (Only admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', Admin::class)->name('admin.vistaAdmin');
    });
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

//para poder acceder al metodo para crear el perfil de publico, será necesario crear una ruta 
//post que llame al metodo store del controlador PublicoController
Route::post('/publico', [PublicoController::class, 'store'])->name('publico.store');