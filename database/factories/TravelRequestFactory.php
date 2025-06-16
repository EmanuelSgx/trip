<?php

namespace Database\Factories;

use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelRequest>
 */
class TravelRequestFactory extends Factory
{
    protected $model = TravelRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departureDate = fake()->dateTimeBetween('+1 week', '+3 months');
        $returnDate = fake()->dateTimeBetween($departureDate, '+4 months');

        return [
            'user_id' => User::factory(),
            'requester_name' => fake()->name(),
            'destination' => fake()->randomElement([
                'São Paulo', 'Rio de Janeiro', 'Brasília', 'Belo Horizonte',
                'Salvador', 'Fortaleza', 'Recife', 'Porto Alegre',
                'Curitiba', 'Manaus', 'Belém', 'Goiânia'
            ]),
            'departure_date' => $departureDate->format('Y-m-d'),
            'return_date' => $returnDate->format('Y-m-d'),
            'status' => fake()->randomElement([
                TravelRequest::STATUS_PENDING,
                TravelRequest::STATUS_APPROVED,
                TravelRequest::STATUS_CANCELLED
            ]),
            'notes' => fake()->optional()->sentence(),
            'cancellation_reason' => null,
            'approved_at' => null,
            'cancelled_at' => null,
            'approved_by' => null,
        ];
    }

    /**
     * Indicate that the travel request is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TravelRequest::STATUS_PENDING,
            'approved_at' => null,
            'cancelled_at' => null,
            'approved_by' => null,
            'cancellation_reason' => null,
        ]);
    }

    /**
     * Indicate that the travel request is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TravelRequest::STATUS_APPROVED,
            'approved_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'approved_by' => User::factory(),
            'cancelled_at' => null,
            'cancellation_reason' => null,
        ]);
    }

    /**
     * Indicate that the travel request is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TravelRequest::STATUS_CANCELLED,
            'cancelled_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'cancellation_reason' => fake()->sentence(),
            'approved_at' => null,
            'approved_by' => null,
        ]);
    }
}
