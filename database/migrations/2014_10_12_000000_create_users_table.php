<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name')->nullable();
        $table->string('phone_number')->nullable();
        $table->text('picture')->nullable();
        $table->string('email')->unique();
        $table->string('password')->nullable();
        $table->rememberToken();
        $table->timestamp('last_online')->nullable();
        $table->string('verification_code')->nullable();
        $table->string('new_email')->nullable();
        $table->integer('status')->nullable();
        $table->boolean('first')->default(false);
        $table->timestamp('last_accept_date')->nullable();
        $table->string('company_contact')->nullable();
        $table->decimal('credits', 8, 2)->nullable();
        $table->boolean('first_trip')->default(false);
        $table->boolean('incomplete_profile')->default(false);
        $table->boolean('phone_verify')->default(false);
        $table->string('token_auto_login')->nullable();
        $table->string('user_vertical')->nullable();
        $table->unsignedBigInteger('language_id')->nullable();
        $table->boolean('no_registered')->default(false);
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
