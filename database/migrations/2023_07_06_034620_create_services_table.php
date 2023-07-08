<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id');
            $table->string('external_budget_id');
            $table->integer('external_route_id');
            $table->unsignedBigInteger('track_id')->nullable();
            $table->string('name')->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('timestamp');
            $table->string('arrival_address');
            $table->dateTime('arrival_timestamp');
            $table->string('departure_address');
            $table->dateTime('departure_timestamp');
            $table->integer('capacity');
            $table->integer('confirmed_pax_count');
            $table->dateTime('reported_departure_timestamp')->nullable();
            $table->float('reported_departure_kms')->nullable();
            $table->dateTime('reported_arrival_timestamp')->nullable();
            $table->float('reported_arrival_kms')->nullable();
            $table->string('reported_vehicle_plate_number')->nullable();
            $table->integer('status');
            $table->json('status_info');
            $table->integer('reprocess_status');
            $table->boolean('return');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('synchronized_downstream')->nullable();
            $table->dateTime('synchronized_upstream')->nullable();
            $table->integer('province_id');
            $table->integer('sale_tickets_drivers');
            $table->text('notes_drivers')->nullable();
            $table->text('itinerary_drivers');
            $table->decimal('cost_if_externalized', 10, 2)->nullable();

            
            
            $table->foreign('external_route_id')->references('external_id')->on('routes');





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
