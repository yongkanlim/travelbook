<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attraction_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->integer('adult_tickets');
            $table->integer('child_tickets');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attraction_bookings');
    }
};
