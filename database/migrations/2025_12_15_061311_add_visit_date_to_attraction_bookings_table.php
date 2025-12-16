<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('attraction_bookings', function (Blueprint $table) {
            $table->date('visit_date')->after('attraction_id');
        });
    }

    public function down()
    {
        Schema::table('attraction_bookings', function (Blueprint $table) {
            $table->dropColumn('visit_date');
        });
    }
};
