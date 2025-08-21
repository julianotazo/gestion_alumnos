<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public string $name = '';
    public string $email = '';

    public ?string $phone = null;
    public string $dni = '';       // requerido (7..10 dígitos)
    public string $legajo = '';    // requerido (5 dígitos)
    public string $comision = '';  // requerido ('2.1' | '2.2')

    public ?string $linkedin_url = null; // opcional
    public ?string $github_url = null;   // opcional

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $u = Auth::user();

        $this->name         = (string) $u->name;
        $this->email        = (string) $u->email;

        $this->phone        = $u->phone;
        $this->dni          = (string) ($u->dni ?? '');
        $this->legajo       = (string) ($u->legajo ?? '');
        $this->comision     = (string) ($u->comision ?? '');

        $this->linkedin_url = $u->linkedin_url;
        $this->github_url   = $u->github_url;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique(User::class, 'email')->ignore($user->id),
            ],

            'phone'    => ['nullable', 'string', 'max:50'],

            // Ajusta 'required' si en tu proyecto DNI fuese opcional.
            'dni'      => ['required', 'digits_between:7,10', Rule::unique('users', 'dni')->ignore($user->id)],
            'legajo'   => ['required', 'digits:5',           Rule::unique('users', 'legajo')->ignore($user->id)],
            'comision' => ['required', Rule::in(['2.1', '2.2'])],

            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url'   => ['nullable', 'url', 'max:255'],
        ]);

        // Asignación segura (requiere $fillable en el modelo User)
        $user->fill([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'] ?? null,
            'dni'          => $validated['dni'],
            'legajo'       => $validated['legajo'],
            'comision'     => $validated['comision'],
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'github_url'   => $validated['github_url'] ?? null,
        ]);

        // Si cambió el email, marcar como no verificado (tu flujo actual)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Evento para el <x-action-message ... on="profile-updated">
        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.settings.profile');
    }
}
