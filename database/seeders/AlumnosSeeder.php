<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AlumnosSeeder extends Seeder
{
    public function run(): void
    {
        // Cantidad aleatoria por comisión (podés fijar números si preferís)
        $n21 = rand(5, 10);
        $n22 = rand(5, 10);

        // Comisión 2.1
        User::factory()
            ->count($n21)
            ->state(fn () => ['comision' => '2.1', 'is_admin' => false])
            ->create();

        // Comisión 2.2
        User::factory()
            ->count($n22)
            ->state(fn () => ['comision' => '2.2', 'is_admin' => false])
            ->create();
    }
}
