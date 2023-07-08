<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarDaysDisabledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_days_disableds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_id');
            $table->dateTime('day');
            $table->boolean('enabled');
            $table->timestamps();

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
        Schema::dropIfExists('calendar_days_disableds');
    }
}
