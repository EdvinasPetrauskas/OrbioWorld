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
        Schema::create('booker_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booker_id');
            $table->unsignedBigInteger('guest_id')->unique();

            $table->foreign('booker_id')->references('id')->on('bookers')->onDelete('cascade');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookers_guests');
    }
};
