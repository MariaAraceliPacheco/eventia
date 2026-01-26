<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\HomePage;
use App\Livewire\Auth\Login;

Route::get('/', HomePage::class);

Route::get('/login', Login::class)->name('login');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/profile', 'profile')->name('profile.edit');
