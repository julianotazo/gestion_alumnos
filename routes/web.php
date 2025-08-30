<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\ProfileSettings;
use Illuminate\Support\Facades\Route;
use App\Livewire\AlumnosList;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', ProfileSettings::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});    

// Solo Admin
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/alumnos', AlumnosList::class)->name('alumnos.index');
    
});

// Solo Alumno
Route::middleware(['auth','alumno'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');

});


require __DIR__.'/auth.php';
