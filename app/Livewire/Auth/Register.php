<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class Register extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $password_confirmation;
    public $phone, $professional_url;
    public $photo; // <-- archivo subido

    protected function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'phone' => ['nullable','string','max:50'],
            'professional_url' => ['nullable','url','max:255'],
            'photo' => ['nullable','image','max:2048'], // 2MB
            'password' => ['required','string','min:8','confirmed'],
        ];
    }

    public function register()
    {
        $this->validate();

        // Subir foto si viene
        $photoPath = null;
        if ($this->photo) {
            // Guarda en storage/app/public/photos con nombre hasheado
            $photoPath = $this->photo->store('photos', 'public');
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'professional_url' => $this->professional_url,
            'photo_path' => $photoPath,        // <-- guarda la ruta
            'password' => Hash::make($this->password),
            // 'is_admin' => false, // por defecto la migración lo deja en false
        ]);

        event(new Registered($user));

        // Iniciar sesión y redirigir
        auth()->login($user);

        return redirect()->route('dashboard'); // ajustá la ruta a tu flujo
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}