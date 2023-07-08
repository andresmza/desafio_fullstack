<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('calendar_id');
            $table->unsignedBigInteger('vinculation_route')->nullable();
            $table->boolean('route_circular');
            $table->dateTime('date_init');
            $table->dateTime('date_finish');
            $table->boolean('mon');
            $table->boolean('tue');
            $table->boolean('wed');
            $table->boolean('thu');
            $table->boolean('fri');
            $table->boolean('sat');
            $table->boolean('sun');
            $table->timestamps();

            $table->foreign('route_id')->references('id')->on('routes');
            $table->foreign('calendar_id')->references('id')->on('calendars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes_data');
    }
}
