<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // TravelRequestSeeder::class, // Vazio em produção
        ]);
        
        // Para incluir dados de teste, execute:
        // php artisan db:seed --class=TravelRequestTestSeeder
    }
}
