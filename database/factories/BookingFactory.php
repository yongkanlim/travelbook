<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Destination;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'destination_id' => Destination::inRandomOrder()->first()->id,
            'travel_date' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'people' => $this->faker->numberBetween(1, 5),
        ];
    }
}
