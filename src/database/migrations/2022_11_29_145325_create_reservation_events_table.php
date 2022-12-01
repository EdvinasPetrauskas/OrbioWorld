<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_events', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->dateTime('reservation_date');
            $table->json('available_restaurant_tables_ids');
            $table->integer('available_seats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_events');
    }
};
