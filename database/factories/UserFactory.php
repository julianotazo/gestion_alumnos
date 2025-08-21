<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        // Si querés nombres argentinos, en config/app.php poné: 'faker_locale' => 'es_AR'
        $name = $this->faker->name();

        // DNI 7..10 dígitos (único)
        $dniLength = $this->faker->numberBetween(7, 10);
        $dni = $this->faker->unique()->numerify(str_repeat('#', $dniLength));

        // Legajo exactamente 5 dígitos (único)
        $legajo = $this->faker->unique()->numerify('#####');

        // Teléfono E.164 “argentino” plausible (texto)
        $phone = '+54 9 351 ' . $this->faker->numerify('#######');

        return [
            'name'           => $name,
            'email'          => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'       => Hash::make('alumno123'), // contraseña de demo
            'remember_token' => Str::random(10),

            'phone'          => $phone,
            'dni'            => $dni,
            'legajo'         => $legajo,
            'comision'       => '2.1', // por defecto; la seteamos con states en el seeder
            'linkedin_url'   => $this->faker->optional(0.6)->url(), // opcional
            'github_url'     => $this->faker->optional(0.5)->url(), // opcional
            'photo_path'     => null,
            'is_admin'       => false, // alumnos
        ];
    }
}
