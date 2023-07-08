<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id')->nullable();
            $table->string('invitation_code');
            $table->string('title');
            $table->integer('pax');
            $table->dateTime('start_timestamp');
            $table->dateTime('end_timestamp');
            $table->timestamps();

            $table->unique('external_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
