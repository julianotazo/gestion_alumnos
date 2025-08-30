<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class ProfileSettings extends Component
{
    use WithFileUploads;

    // Datos del perfil
    public $name, $email, $phone, $comision, $dni, $legajo, $linkedin_url, $github_url;

    // Nueva foto de perfil
    public $newPhoto;

    public function mount(): void
    {
        $u = auth()->user();
        $this->name         = $u->name;
        $this->email        = $u->email;
        $this->phone        = $u->phone;
        $this->comision     = $u->comision;
        $this->dni          = $u->dni;
        $this->legajo       = $u->legajo;
        $this->linkedin_url = $u->linkedin_url;
        $this->github_url   = $u->github_url;
    }

    public function updateProfileInformation(): void
    {
        $u = auth()->user();

        $this->validate([
            'name'         => ['required','string','max:255'],
            'email'        => ['required','email','max:255', Rule::unique('users','email')->ignore($u->id)],
            'phone'        => ['nullable','string','max:50'],
            'comision'     => ['nullable','string','max:10'],
            'dni'          => ['required','regex:/^[0-9]{7,10}$/'],
            'legajo'       => ['required','regex:/^[0-9]{5}$/'],
            'linkedin_url' => ['nullable','url','max:255'],
            'github_url'   => ['nullable','url','max:255'],
        ], [
            'dni.regex'    => 'El DNI debe tener entre 7 y 10 dígitos.',
            'legajo.regex' => 'El Legajo debe tener exactamente 5 dígitos.',
        ]);

        $u->update([
            'name'         => $this->name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'comision'     => $this->comision,
            'dni'          => $this->dni,
            'legajo'       => $this->legajo,
            'linkedin_url' => $this->linkedin_url,
            'github_url'   => $this->github_url,
        ]);

        $this->dispatch('profile-updated'); // para <x-action-message on="profile-updated" />
        session()->flash('status', 'Datos actualizados.');
    }

    public function updateProfilePhoto(): void
    {
        $this->validate([
            'newPhoto' => ['required','image','max:5120'], // 5MB
        ]);

        $u = auth()->user();

        // Guarda con nombre hasheado en storage/app/public/photos
        $path = $this->newPhoto->store('photos', 'public');

        // (Opcional) borra la anterior si existía
        if ($u->photo_path && \Storage::disk('public')->exists($u->photo_path)) {
            \Storage::disk('public')->delete($u->photo_path);
        }

        $u->update(['photo_path' => $path]);

        $this->reset('newPhoto');
        $this->dispatch('profile-updated');
        session()->flash('photo_status', 'Foto de perfil actualizada.');
    }

    public function render()
    {
        return view('livewire.settings.profile-settings');
    }
}
