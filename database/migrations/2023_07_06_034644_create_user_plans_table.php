<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('next_user_plan_id')->nullable();
            $table->dateTime('start_timestamp')->nullable();
            $table->dateTime('end_timestamp')->nullable();
            $table->dateTime('renewal_timestamp')->nullable();
            $table->decimal('renewal_price', 20, 10);
            $table->boolean('requires_invoice');
            $table->integer('status');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('financiation');
            $table->integer('status_financiation');
            $table->string('language');
            $table->string('nif');
            $table->string('business_name');
            $table->boolean('pending_payment');
            $table->dateTime('date_max_payment')->nullable();
            $table->dateTime('proxim_start_timestamp')->nullable();
            $table->dateTime('proxim_end_timestamp')->nullable();
            $table->dateTime('proxim_renewal_timestamp')->nullable();
            $table->decimal('proxim_renewal_price', 20, 10)->nullable();
            $table->float('credits_return');
            $table->integer('company_id');
            $table->boolean('cancel_employee');
            $table->boolean('force_renovation');
            $table->dateTime('date_canceled')->nullable();
            $table->decimal('amount_confirm_canceled', 20, 10)->nullable();
            $table->float('credit_confirm_canceled')->nullable();
            $table->integer('cost_center_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_plans');
    }
}
