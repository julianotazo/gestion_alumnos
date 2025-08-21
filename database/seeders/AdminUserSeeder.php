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
        // Usá la misma contraseña para ambos (editable por config)
        $pass = config('admin.password', 'admin123');

        $admins = [
            [
                'name'         => config('admin.name', 'Administrador1'),
                'email'        => config('admin.email', 'admin1@demo.com'),
                'dni'          => '12345678',
                'legajo'       => '00001',
                'comision'     => '2.1',
                'phone'        => '3704000001',
                'linkedin_url' => null,
                'github_url'   => null,
            ],
            [
                'name'         => 'Administrador2',
                'email'        => 'admin2@demo.com',
                'dni'          => '12345679',
                'legajo'       => '00002',
                'comision'     => '2.2',
                'phone'        => '3704000002',
                'linkedin_url' => null,
                'github_url'   => null,
            ],
        ];

        foreach ($admins as $a) {
            User::updateOrCreate(
                ['email' => $a['email']],
                [
                    'name'              => $a['name'],
                    'password'          => Hash::make($pass),
                    'is_admin'          => true,
                    'phone'             => $a['phone'],
                    'dni'               => $a['dni'],
                    'legajo'            => $a['legajo'],
                    'comision'          => $a['comision'],
                    'linkedin_url'      => $a['linkedin_url'],
                    'github_url'        => $a['github_url'],
                    'photo_path'        => null,
                    'email_verified_at' => now(),
                    'remember_token'    => Str::random(10),
                ]
            );
        }
    }
}

