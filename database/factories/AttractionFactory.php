<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttractionFactory extends Factory
{
    public function definition(): array
    {
        // Predefined attraction types
        $types = ['zoo', 'museum', 'park', 'beach', 'mountain', 'aquarium'];

        // Pick a type for this attraction
        $type = $this->faker->randomElement($types);

        // Name includes the type
        $name = ucfirst($type) . ' ' . $this->faker->company;

        // Generate a unique number for each image to ensure different images
        $uniqueSeed = $this->faker->unique()->numberBetween(1, 1000);

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(3),
            'location' => $this->faker->city . ', ' . $this->faker->country,
            'adult_price' => $this->faker->numberBetween(50, 300),
            'child_price' => $this->faker->numberBetween(20, 150),
            'available_adult_tickets' => $this->faker->numberBetween(50, 200),
            'available_child_tickets' => $this->faker->numberBetween(20, 100),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            // LoremFlickr URL with type + unique seed ensures different image per attraction
            'image' => "https://loremflickr.com/600/400/{$type}?lock={$uniqueSeed}",
        ];
    }
}
