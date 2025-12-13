<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Hotel',
            'description' => $this->faker->paragraph(3),
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'price' => $this->faker->numberBetween(150, 800),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'people' => $this->faker->randomElement([2, 3, 4]),
        ];
    }
}
