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
            'photo' => ['required','image','max:5120'],
        ]);

        $user = auth()->user();

        // (opcional) borrar anterior si existe
        if ($user->photo_path && Storage::disk('public')->exists($user->photo_path)) {
            Storage::disk('public')->delete($user->photo_path);
        }

        // guarda en storage/app/public/photos
        $path = $this->photo->store('photos', 'public');

        $user->update(['photo_path' => $path]);

        // limpiar selección y feedback
        $this->reset('photo');
        session()->flash('message', 'Foto de perfil actualizada correctamente.');
    }

    public function render()
    {
        return view('livewire.profile-photo');
    }
}
