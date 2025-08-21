<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProfilePhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:2048', // Máx 2MB
        ]);

        // Guardar la foto con nombre hasheado en /storage/app/public/photos
        $path = $this->photo->store('photos', 'public');

        // Actualizar el usuario logueado
        auth()->user()->update([
            'photo_path' => $path,
        ]);

        session()->flash('message', 'Foto de perfil actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.profile-photo');
    }
}
