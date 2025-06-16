<?php

namespace Database\Seeders;

use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class TravelRequestTestSeeder extends Seeder
{
    /**
     * Run the database seeds for testing purposes.
     * Use: php artisan db:seed --class=TravelRequestTestSeeder
     */
    public function run(): void
    {
        // Criar usuários comuns para teste
        $user1 = User::create([
            'name' => 'João Silva',
            'email' => 'joao@triptech.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@triptech.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Criar solicitações de viagem de teste
        TravelRequest::create([
            'user_id' => $user1->id,
            'requester_name' => 'João Silva',
            'destination' => 'São Paulo - SP',
            'departure_date' => now()->addDays(15),
            'return_date' => now()->addDays(18),
            'status' => TravelRequest::STATUS_PENDING,
            'notes' => 'Reunião com cliente importante',
        ]);

        TravelRequest::create([
            'user_id' => $user1->id,
            'requester_name' => 'João Silva',
            'destination' => 'Rio de Janeiro - RJ',
            'departure_date' => now()->addDays(30),
            'return_date' => now()->addDays(33),
            'status' => TravelRequest::STATUS_APPROVED,
            'notes' => 'Conferência de tecnologia',
            'approved_at' => now()->subDay(),
            'approved_by' => 1, // Admin
        ]);

        TravelRequest::create([
            'user_id' => $user2->id,
            'requester_name' => 'Maria Santos',
            'destination' => 'Belo Horizonte - MG',
            'departure_date' => now()->addDays(7),
            'return_date' => now()->addDays(10),
            'status' => TravelRequest::STATUS_PENDING,
            'notes' => 'Treinamento técnico',
        ]);

        TravelRequest::create([
            'user_id' => $user2->id,
            'requester_name' => 'Maria Santos',
            'destination' => 'Salvador - BA',
            'departure_date' => now()->addDays(45),
            'return_date' => now()->addDays(48),
            'status' => TravelRequest::STATUS_CANCELLED,
            'notes' => 'Evento cancelado devido a circunstâncias imprevistas',
            'cancelled_at' => now()->subDays(2),
            'cancellation_reason' => 'Evento cancelado pelo organizador',
        ]);
    }
}
