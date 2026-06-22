<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // USER NORMAL
        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}