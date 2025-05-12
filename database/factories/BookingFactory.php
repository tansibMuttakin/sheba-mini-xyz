<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => $this->faker->name(),
            'user_id'      => User::factory(),
            'phone'        => $this->faker->phoneNumber(),
            'service_id'   => Service::factory(), // creates a related service
            'status'       => 'pending',
            'scheduled_at' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
        ];
    }
}
