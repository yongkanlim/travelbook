<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        Attraction::factory()->count(20)->create();
    }
}
