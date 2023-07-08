<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_plan_id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('track_id')->nullable();
            $table->dateTime('reservation_start');
            $table->dateTime('reservation_end');
            $table->unsignedBigInteger('route_stop_origin_id');
            $table->unsignedBigInteger('route_stop_destination_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_plan_id')->references('id')->on('user_plans');
            $table->foreign('route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
