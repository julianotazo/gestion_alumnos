<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Podés mover estos valores a .env si querés
        $name  = config('admin.name', 'Administrador');
        $email = config('admin.email', 'admin@demo.com');
        $pass  = config('admin.password', 'admin123');
        
        // Crea o actualiza si ya existe el email
        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($pass),
                'is_admin' => true,
                'phone' => '+54 9 351 000 0000',
                'professional_url' => 'https://www.linkedin.com/',
                'photo_path' => null,
                'email_verified_at' => now(), // útil si usás verificación de email
                'remember_token' => Str::random(10),
            ]
        );
    }
}
