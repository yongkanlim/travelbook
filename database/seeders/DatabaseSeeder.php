<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Destination;
use App\Models\Booking;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        // User::factory(10)->create();

        // Destinations (Hotels)
        Destination::factory(20)->create();

        // Bookings
        // Booking::factory(30)->create();
    }
}
