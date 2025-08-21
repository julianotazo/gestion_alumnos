<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AlumnosList extends Component
{
    public function render()
    {
        $alumnos = User::where('is_admin', false)->get();

        return view('livewire.alumnos-list', [
            'alumnos' => $alumnos,
        ]);
    }
}
