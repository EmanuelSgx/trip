<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@triptech.com',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        // Create default regular user for testing
        User::create([
            'name' => 'Usuário Teste',
            'email' => 'user@triptech.com',
            'password' => Hash::make('user123'),
            'role' => User::ROLE_USER,
            'email_verified_at' => now(),
        ]);
    }
}
