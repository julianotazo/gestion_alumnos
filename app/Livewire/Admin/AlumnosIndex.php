<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AlumnosIndex extends Component
{
    public string $comision = '2.1';

    public function mount(): void
    {
        // Solo admins
        abort_unless(Auth::user() && Auth::user()->is_admin, 403);

        // Normalizamos la comisión inicial
        if (!in_array($this->comision, ['2.1', '2.2'], true)) {
            $this->comision = '2.1';
        }
    }

    public function setComision(string $c): void
    {
        if (in_array($c, ['2.1', '2.2'], true)) {
            $this->comision = $c;
        }
    }

    public function render()
    {
        $alumnos = User::query()
            ->select(['legajo', 'name', 'email', 'phone', 'dni'])
            ->where('comision', $this->comision)
            ->where('is_admin', false)
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.admin.alumnos-index', compact('alumnos'));
    }
}
