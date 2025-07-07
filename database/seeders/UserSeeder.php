<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Wownator',
            'email' => 'admin@wownator.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);
        User::create([
            'name' => 'Jogador Teste',
            'email' => 'player@wownator.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'email_verified_at' => now(),
        ]);
    }
}
