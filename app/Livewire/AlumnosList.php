<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class AlumnosList extends Component
{
    // Comisión seleccionada (2.1 por defecto)
    public string $comision = '2.1';

    public function mount(): void
    {
        // Solo admins
        abort_unless(Auth::user() && (Auth::user()->is_admin ?? false), 403);

        // Normalizar valor inicial por si viene vacío o inválido
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
        $query = User::query()
            ->select(['legajo', 'name', 'email', 'phone', 'dni'])
            ->where('comision', $this->comision);

        // Si existe la columna is_admin, filtramos para no listar admins
        if (Schema::hasColumn('users', 'is_admin')) {   // <-- acá va Schema::hasColumn(...)
            $query->where('is_admin', false);
        }

        $alumnos = $query->orderBy('name', 'asc')->get();

        // En la vista usaremos $alumnos y $this->comision
        return view('livewire.alumnos-list', compact('alumnos'));
    }
}
