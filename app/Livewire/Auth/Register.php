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

    public $phone;
    public $dni;
    public $legajo; 
    public $comision; 
    public $linkedin_url;   
    public $github_url;
    public $photo;

    protected function rules()
    {
        return [
            'name'              => ['required','string','max:255'],
            'email'             => ['required','string','email','max:255','unique:users,email'],
            'password'          => ['required','string','min:8','confirmed'],
            'phone'             => ['nullable','string','max:50'],
            'dni'               => ['required','digits_between:7,10','unique:users,dni'],
            'legajo'            => ['required','digits:5','unique:users,legajo'],
            'comision'          => ['required','in:2.1,2.2'],
            'linkedin_url'      => ['nullable','url','max:255'],
            'github_url'        => ['nullable','url','max:255'],
            'photo'             => ['nullable','image','max:5120'],
        ];
    }

    public function register()
    {
        $data = $this->validate();

        // Subir foto si viene
        $photoPath = null;
        if ($this->photo) {
            // Guarda en storage/app/public/photos con nombre hasheado
            $photoPath = $this->photo->store('photos', 'public');
        }

        $user = User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'phone'         => $data['phone'] ?? null,
            'dni'           => $data['dni'],
            'legajo'        => $data['legajo'],
            'comision'      => $data['comision'],
            'linkedin_url' => $data['linkedin_url'] ?? null,
            'github_url'   => $data['github_url'] ?? null,
            'photo_path'    => $photoPath,
        ]);

        event(new Registered($user));

        auth()->login($user);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}